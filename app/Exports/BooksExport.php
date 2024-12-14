<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements WithHeadings, ShouldAutoSize, FromArray
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function  array():array
    {
       $books = Book::all();
       $books_filter = [];
       $no = 1;
       for($i=0; $i < $books->count(); $i++){
            $books_filter[$i]['no'] = $no++;
            $books_filter[$i]['title'] = $books[$i]->title;
            $books_filter[$i]['author'] = $books[$i]->author;
            $books_filter[$i]['year'] = $books[$i]->year;
            $books_filter[$i]['publisher'] = $books[$i]->publisher;
            $books_filter[$i]['bookshelf_id'] = $books[$i]->bookshelf->name;
       }
       return $books_filter;
    }
    public function headings(): array{
        return [    
            'No',
            'Judul',
            'Penulis',
            'Tahun Terbit',
            'Penerbit',
            'Rak',
        ];
    }
}
