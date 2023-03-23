<?php

namespace App\Models;

use CodeIgniter\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['name','image'];

    public function getAllBooks()
    {   
        return $this->orderBy('id','ASC')->findAll();
    }  

    public function saveBook($data){
        $this->insert($data);
    }

    public function getOneBook($id){
        $book = $this->where('id',$id)->first();
        return $book;
    }

    public function updateBook($id,$data){
        $this->update($id,$data);
    }

    public function deleteBook($id){
        $this->where('id',$id)->delete();
    }
}