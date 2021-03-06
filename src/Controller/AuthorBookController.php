<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Author;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AuthorBookController extends AbstractController
{
	
    /**
     * @Route("/author/book", name="author_book")
     */
    public function index(Request $request)
    {
        return new JsonResponse([
        	"income"=> "100"]);
    }
    /**
     * @Route("/save", name="save")
     */
    public function saves(Request $request)
    {
    	$entityManager = $this->getDoctrine()->getManager();
    	$author=new Book();
    	$author->setTitle('Article54');
        $author->setAuthors(['aaa']);
        $entityManager->persist($author);

        $entityManager->flush();

        return new Response('saves new books'.$author->getId());
    }
    /**
     * @Route("/gets", name="gets")
     */
    public function gets(Request $request)
    {
    	$entityManager = $this->getDoctrine()->getManager();
    	$retrieve = $entityManager->getRepository(Book::class)->findAll();
    	$author = $this->getDoctrine()->getRepository(Book::class)->findAll();
    	$test=(array) $author[0];
    	$test1=array_values($test);
    	var_dump($test1);
    	$parametersAsArray = [];
	    if ($content = $request->getContent()) {
	        $parametersAsArray = json_decode($content, true);
	    }
        return new JsonResponse([
        	"data"=> $parametersAsArray]);
    }


    /**
     * @Route("/api/authors", name="postAuthors", methods={"POST"})
     */
    public function apiAuthors(Request $request)
    {
		$parametersAsArray = [];
	    if ($content = $request->getContent()) {
	        $parametersAsArray = json_decode($content, true);
	    }
	    $authorsName=$parametersAsArray['name'];
	    $authorsEmail=$parametersAsArray['email'];
    	$entityManager = $this->getDoctrine()->getManager();
    	$author=new Author();
    	$author->setName($authorsName);
        $author->setEmail($authorsEmail);
        $author->setBooksCount(0);
        $entityManager->persist($author);

        $entityManager->flush();
		// $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
		//   ->setUsername('11e2fa66fa326a') // generated by Mailtrap
		//   ->setPassword('66279661a93017') // generated by Mailtrap
		// ;
		// $mailer = new Swift_Mailer($transport);

		// // Create a message
		// $message = (new Swift_Message('Library'))
		//   ->setFrom(['yousuf.mohammad@student.unisi.it' => 'Yousuf M'])
		//   ->setTo([ $authorsEmail => $authorsName])
		//   ->setBody('You are added to our database')
		//   ;

		// // Send the message
		// $numSent = $mailer->send($message);
        return new JsonResponse([
        	"name"=> $authorsName,
        	"email"=> $authorsEmail]);
    }
    /**
     * @Route("/api/authors/{id}", name="putAuthors", methods={"PUT"})
     */
    public function apiAuthorsEdit(int $id,Request $request)
    {
		$parametersAsArray = [];
	    if ($content = $request->getContent()) {
	        $parametersAsArray = json_decode($content, true);
	    }
	    $entityManager = $this->getDoctrine()->getManager();
	    $booksAuthor = $entityManager->getRepository(Author::class)->find($id);
	    $booksAuthorList=(array) $booksAuthor;
	    $booksAuthorList=array_values($booksAuthorList);
	    $authorsName=$parametersAsArray['name'];
	    $authorsEmail=$parametersAsArray['email'];
		empty($booksAuthorList[0]) ? true : $booksAuthor->setName($authorsName);
		empty($booksAuthorList[1]) ? true : $booksAuthor->setEmail($authorsEmail);
		$entityManager->persist($booksAuthor);
		$entityManager->flush();
		$booksAuthor = $entityManager->getRepository(Author::class)->find($id);
	    $booksAuthor=(array) $booksAuthor;
	    $booksAuthor=array_values($booksAuthor);
	    $authorsName=$booksAuthor[1];
	    $authorsEmail=$booksAuthor[2];		
        return new JsonResponse([
        	"name"=> $authorsName,
        	"email"=> $authorsEmail]);
    }


    /**
     * @Route("/api/authors", name="getAllAuthors", methods={"GET"})
     */
    public function apiAuthorsAll(Request $request)
    {
    	$entityManager = $this->getDoctrine()->getManager();
	    $booksAuthors = $entityManager->getRepository(Author::class)->findAll();
	    $data = [];

	    foreach ($booksAuthors as $booksAuthor) {
	    	$booksAuthor=(array) $booksAuthor;
	    	$booksAuthor=array_values($booksAuthor);
	        $data[] = [
	            'id' => $booksAuthor[0],
	            'name' => $booksAuthor[1],
	            'email' => $booksAuthor[2],
	            'booksCount' => $booksAuthor[3],
	        ];
	    }
	    return new JsonResponse(["hydra:member"=>$data,
								"hydra:totalItems"=>count($data)], Response::HTTP_OK);	}
    /**
     * @Route("/api/authors/{id}", name="=getAuthor", methods={"GET"})
     */
    public function apiAuthor(int $id,Request $request)
    {
	    $entityManager = $this->getDoctrine()->getManager();
	    $booksAuthor = $entityManager->getRepository(Author::class)->find($id);
	    $booksAuthor=(array) $booksAuthor;
	    $booksAuthor=array_values($booksAuthor);

		
        return new JsonResponse([
        	'id' => $booksAuthor[0],
	            'name' => $booksAuthor[1],
	            'email' => $booksAuthor[2],
	            'booksCount' => $booksAuthor[3]]);
    }



    /**
     * @Route("/api/books", name="postBooks", methods={"POST"})
     */
    public function apiBooks(Request $request)
    {
		$parametersAsArray = [];
	    if ($content = $request->getContent()) {
	        $parametersAsArray = json_decode($content, true);
	    }
	    
	    $booksName=$parametersAsArray['title'];
	    $authorsLists=(array) $parametersAsArray['authors'];
	    $authors = [];
	    foreach ($authorsLists as $authorsList) {

	    	$entityManager = $this->getDoctrine()->getManager();
	    	$authorId=explode("/", $authorsList);
	    	$authorId=end($authorId);
	    	$authorId=(int)$authorId;
			$booksAuthor = $entityManager->getRepository(Author::class)->find($authorId);
		    $booksAuthorList=(array) $booksAuthor;
		    $booksAuthorList=array_values($booksAuthorList);
			// empty($booksAuthorList[3]) ? true : $booksAuthor->setBooksCount($booksAuthorList[3]+1);
			if ($booksAuthor){
				$booksAuthor->setBooksCount($booksAuthorList[3]+1);
				$entityManager->persist($booksAuthor);
				$entityManager->flush();
				$authors[] = [
	            'id' => $booksAuthor->getId(),
	            'name' => $booksAuthor->getName(),
	            'email' => $booksAuthor->getEmail(),
	            'booksCount' => $booksAuthor->getBooksCount(),
	        ];
			}

	    }
	    $entityManager = $this->getDoctrine()->getManager();
    	$book=new Book();
    	$book->setTitle($booksName);
        $book->setAuthors($authorsLists);
        $entityManager->persist($book);

        $entityManager->flush();
        return new JsonResponse([
        	"id"=> $book->getId(),
        	"title"=> $book->getTitle(),
        	"authors"=> $authors]);
    }

    /**
     * @Route("/api/books/{id}", name="putBook", methods={"PUT"})
     */
    public function apiBooksEdit(int $id,Request $request)
    {
		$parametersAsArray = [];
	    if ($content = $request->getContent()) {
	        $parametersAsArray = json_decode($content, true);
	    }
	    $entityManager = $this->getDoctrine()->getManager();
	    $book = $entityManager->getRepository(Book::class)->find($id);
	    $booksAuthorList=(array) $book;
	    $booksAuthorList=array_values($booksAuthorList);
	    $authorsTitle=$parametersAsArray['title'];
	    $authorsAuthors=(array) $parametersAsArray['authors'];
		$authors = [];
	    foreach ($authorsAuthors as $authorsList) {

	    	$entityManager = $this->getDoctrine()->getManager();
	    	$authorId=explode("/", $authorsList);
	    	$authorId=end($authorId);
	    	$authorId=(int)$authorId;
			$booksAuthor = $entityManager->getRepository(Author::class)->find($authorId);
		    $booksAuthorList=(array) $booksAuthor;
		    $booksAuthorList=array_values($booksAuthorList);
			if ($booksAuthor){
				$booksAuthor->setBooksCount($booksAuthorList[3]+1);
				$entityManager->persist($booksAuthor);
				$entityManager->flush();
				$authors[] = [
	            'id' => $booksAuthor->getId(),
	            'name' => $booksAuthor->getName(),
	            'email' => $booksAuthor->getEmail(),
	            'booksCount' => $booksAuthor->getBooksCount(),
	        ];
			}
		}
		$book->setTitle($authorsTitle);
		$book->setAuthors($authorsAuthors);
		$entityManager->persist($book);
		$entityManager->flush();	
        return new JsonResponse([
        	"id"=>$book->getId(),
        	"title"=> $book->getTitle(),
        	"authors"=>$authors]);	
	}	
    /**
     * @Route("/api/books", name="getAllBooks", methods={"GET"})
     */
    public function apiBooksAll(Request $request)
    {
    	$entityManager = $this->getDoctrine()->getManager();
	    $books = $entityManager->getRepository(Book::class)->findAll();
	    $data = [];

	    foreach ($books as $book) {
		    $bookList=(array) $book;
		    $bookList=array_values($bookList);
	    	$authors=(array) $bookList[2];
	    	$authorsLists = [];
		    foreach ($authors as $authorsList) {
		    	$entityManager = $this->getDoctrine()->getManager();
		    	$authorId=explode("/", $authorsList);
		    	$authorId=end($authorId);
		    	$authorId=(int)$authorId;
				$booksAuthor = $entityManager->getRepository(Author::class)->find($authorId);
				if ($booksAuthor){
					$authorsLists[] = [
		            'id' => $booksAuthor->getId(),
		            'name' => $booksAuthor->getName(),
		            'email' => $booksAuthor->getEmail(),
		            'booksCount' => $booksAuthor->getBooksCount(),
		        ];
				}

		    }
	        $data[] = [
	            'id' => $book->getId(),
	            'title' => $book->getTitle(),
	            'authors' =>(array) $authorsLists,
	        ];
	    }
	    return new JsonResponse(["hydra:member"=>$data,
								"hydra:totalItems"=>count($data)], Response::HTTP_OK);
	}
    /**
     * @Route("/api/books/{id}", name="=getBook", methods={"GET"})
     */
    public function apiBook(int $id,Request $request)
    {
	    $entityManager = $this->getDoctrine()->getManager();
		$book = $entityManager->getRepository(Book::class)->find($id);
	    $bookList=(array) $book;
	    $bookList=array_values($bookList);
    	$authorsLists=(array) $bookList[2];
	    $authors = [];
	    foreach ($authorsLists as $authorsList) {

	    	$entityManager = $this->getDoctrine()->getManager();
	    	$authorId=explode("/", $authorsList);
	    	$authorId=end($authorId);
	    	$authorId=(int)$authorId;
			$booksAuthor = $entityManager->getRepository(Author::class)->find($authorId);
			if ($booksAuthor){
				$authors[] = [
	            'id' => $booksAuthor->getId(),
	            'name' => $booksAuthor->getName(),
	            'email' => $booksAuthor->getEmail(),
	            'booksCount' => $booksAuthor->getBooksCount(),
	        ];
			}

	    }

        return new JsonResponse([
        	'id' => $book->getId(),
            'title' => $book->getTitle(),
            'authors' =>(array) $authors,]);
    }
    /**
     * @Route("/api/books/{id}/delete", name="delBook", methods={"POST"})
     */
    public function apiBookDelete(int $id,Request $request)
    {
	    $entityManager = $this->getDoctrine()->getManager();
		$book = $entityManager->getRepository(Book::class)->find($id);
	    $res=new JsonResponse([
        	'id' => $book->getId(),
            'title' => $book->getTitle(),
            'authors' =>(array) $authors,
            'status'=>"succesful"]);
        $entityManager->remove($book);

        $entityManager->flush();
        return $res;
    }
    /**
     * @Route("/api/authors/{id}/delete", name="delAuthor", methods={"POST"})
     */
    public function apiAuthorDelete(int $id,Request $request)
    {
	    $entityManager = $this->getDoctrine()->getManager();
		$author = $entityManager->getRepository(Author::class)->find($id);
	    $res=new JsonResponse([
        	'id' => $author->getId(),
            'name' => $author->getName(),
            'email' =>$author->getEmail(),
            'booksCount' =>$author->getBooksCount(),
            'status'=>"succesful"]);
        $entityManager->remove($author);

        $entityManager->flush();
        return $res;
    }








}
