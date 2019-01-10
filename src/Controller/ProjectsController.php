<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Project;
use App\Entity\LangCode;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProjectsController extends AbstractController
{
    /**
     * @Route("/projects", name="projects")
     */
    public function index()
    {
        $projectsRepo = $this->getDoctrine()->getRepository(Project::class);
        $projects = $projectsRepo->findAll();

        return $this->render('projects/index.html.twig', ['projects' => $projects]);
    }

    /**
     * @Route("/projects/create", name="projects_create")
     */
    public function create(Request $request, UserInterface $user): Response
    {
        $langsRepo = $this->getDoctrine()->getRepository(LangCode::class);
        $langs = $langsRepo->findAll();

        if ($request->isMethod('POST')) {
            $projectName = $request->request->get('projectName');
            $projectLangId = $request->request->get('projectLangCode');
            $projectLangCode = $langsRepo->find($projectLangId);

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $request->files->get('file');
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('files_dir'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                return $this->render('projects/create.html.twig', ['langs' => $langs, 'error' => $e]);
            }

            $project = new Project();
            $project->setName($projectName);
            $project->setLangCode($projectLangCode);
            $project->setUserId($user);
            $project->setFile($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();
            return $this->redirectToRoute('projects');
        }

        return $this->render('projects/create.html.twig', ['langs' => $langs, 'error' => null]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * @Route("projects/{id}", name="project_delete")
     */
    public function deleteProject(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $repository->find($id);
        /** @var $project SoftDelete */
        $em->setInvisibility($project);
        $em->flush();
    }
}