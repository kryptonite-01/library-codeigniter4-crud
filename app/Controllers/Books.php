<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Book;

class Books extends Controller
{
    public function index()
    {
        $book = model(Book::class);
        $data['books'] = $book->getAllBooks();

        $data['header']=view('templates/header');
        $data['footer']=view('templates/footer');

        return view('books/book_list',$data);
    }

    public function createBook(){

        $data['header']=view('templates/header');
        $data['footer']=view('templates/footer');

        return view('books/create_book',$data);
    }

    public function saveBook(){
        $book = model(Book::class);

        $data['name'] = $this->request->getVar('name');

        //validate selected image and name
        $validateData=$this->validate([
            'name'=>'required|min_length[3]',
            'image'=>[
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg,image/png]',
                'max_size[image,1024]',	
            ]
        ]);

        //redirect if form is empty or wrong inputs
        if(!$validateData){
           $session = session();
           $session->setFlashdata('message','Check the inputs');
           return redirect()->back()->withInput();
        }

        //save file and set unique name
        if($image=$this->request->getFile('image')){
            $newName=$image->getRandomName();
            $image->move('../public/uploads/',$newName);
            $data['image']=$newName;
        }

        //send data to model
        $book->saveBook($data);

        //redirect view
        return $this->response->redirect(base_url('list'));

    }

    public function editBook($id=null){
        $book = model(Book::class);
    
        $data['book'] = $book->getOneBook($id);

        $data['header']=view('templates/header');
        $data['footer']=view('templates/footer');

        return view('books/edit_book',$data);
    }

    public function updateBook(){
        $book = model(Book::class);

        //get form data
        $data['name']=$this->request->getVar('name');
        $id=$this->request->getVar('id');

        //validate name
        $validateData=$this->validate([
            'name'=>'required|min_length[3]',
        ]);

        //redirect if form is empty or wrong inputs
        if(!$validateData){
           $session = session();
           $session->setFlashdata('message','Check the inputs');
           return redirect()->back()->withInput();
        }

        //update name
        $book->updateBook($id,$data);

        //validate selected image
        $validateImage=$this->validate([
            'image'=>[
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg,image/png]',
                'max_size[image,1024]',	
            ]
        ]);

        if($validateImage){
            //save file and set unique name
            if($image=$this->request->getFile('image')){
                $dataBook = $book->getOneBook($id);

                //delete previous image
                $imageRoute=('../public/uploads/'.$dataBook['image']);
                unlink($imageRoute);

                //save new image with unique name
                $newName=$image->getRandomName();
                $image->move('../public/uploads/',$newName);
                $data['image']=$newName;

                //update image name
                $book->updateBook($id,$data);
            }
        }

        return $this->response->redirect(base_url('list'));
    }

    public function deleteBook($id=null){
        $book = model(Book::class);
        //search element to delete on database
        $bookData = $book->getOneBook($id);
    
        //delete image from directory
        $imageRoute=('../public/uploads/'.$bookData['image']);
        unlink($imageRoute);

        //delete row in database
        $book->deleteBook($id);

        return $this->response->redirect(base_url('list'));
    }
}