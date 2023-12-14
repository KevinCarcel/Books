<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    #[Route('api/book', name: 'book', methods: ['GET'])]
    public function getBookList(BookRepository $bookRepository, SerializerInterface $serializer): JsonResponse
    {
        $bookList = $bookRepository->findAll();
        $jsonBookList = $serializer->serialize($bookList,'json');

        return new JsonResponse($jsonBookList, Response::HTTP_OK,[],true);
    }
    #[Route('api/book/{id}', name:'detailBook', methods: ['GET'])]
    public function getDetailBook(int $id ,BookRepository $bookRepository, SerializerInterface $serializer): JsonResponse{

        $book= $bookRepository->find($id);
        if(!$book){
            $jsonBook= $serializer->serialize($book,'json');
            return new JsonResponse($jsonBook, Response::HTTP_OK,[], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}