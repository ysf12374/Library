<?php


namespace App\Tests;


use App\Tests\Util\BaseTestCase;

class ResourceTest extends BaseTestCase
{

    public function testCreateResources()
    {

        $this->createResource('/api/authors', [
            'name'  => 'John Doe',
            'email' => 'johndoe@email.com'
        ], [
            'validateResponse'     => true,
            'validateResponseData' => [
                'id'         => 1,
                'name'       => 'John Doe',
                'email'      => 'johndoe@email.com',
                'booksCount' => 0,
            ]
        ]);

        $this->createResource('/api/authors', [
            'name'  => 'Mario Rossi',
            'email' => 'mariorossi@email.com',
        ], [
            'validateResponse'     => true,
            'validateResponseData' => [
                'id'         => 2,
                'name'       => 'Mario Rossi',
                'email'      => 'mariorossi@email.com',
                'booksCount' => 0,
            ]
        ]);

        $this->updateResource('/api/authors/2', [
            'name' => 'Mariano Rossi',
        ], [
            'validateResponse'     => true,
            'validateResponseData' => [
                'id'         => 2,
                'name'       => 'Mariano Rossi',
                'booksCount' => 0,
            ]
        ]);

        $this->createResource('/api/books', [
            'title' => 'Title 1'
        ]);
        $this->createResource('/api/books', [
            'title' => 'Title 2'
        ]);
        $this->createResource('/api/books', [
            'title'   => 'Title 3',
            'authors' => ['/api/authors/2']
        ], [
            'validateResponse'     => true,
            'validateResponseData' => [
                'title'   => 'Title 3',
                'authors' => [[
                    'id'   => 2,
                    'name' => 'Mariano Rossi'
                ]]
            ]
        ]);
        $this->assertEmailCount(1);
        $this->assertEmailAddressContains($this->getMailerMessage(0), 'to', 'mariorossi@email.com');

        $this->getResource('/api/authors/2', [], [
            'validateResponse'     => true,
            'validateResponseData' => [
                'id'         => 2,
                'booksCount' => 1
            ]
        ]);

        $this->updateResource('/api/books/1', [
            'authors' => ['/api/authors/1']
        ], ['validateResponse' => false]);
        $this->assertEmailCount(1);
        $this->assertEmailAddressContains($this->getMailerMessage(0), 'to', 'johndoe@email.com');
        $this->getResource('/api/authors/1', [], [
            'validateResponse'     => true,
            'validateResponseData' => ['booksCount' => 1]
        ]);

        $this->updateResource('/api/books/2', [
            'name'    => 'Mariano Rossi',
            'authors' => ['/api/authors/1']
        ], ['validateResponse' => false]);
        $this->assertEmailCount(1);
        $this->assertEmailAddressContains($this->getMailerMessage(0), 'to', 'johndoe@email.com');
        $this->getResource('/api/authors/1', [], [
            'validateResponse'     => true,
            'validateResponseData' => ['booksCount' => 2]
        ]);


        $this->updateResource('/api/books/2', [
            'name'    => 'Mariano Rossi',
            'authors' => []
        ], ['validateResponse' => false]);
        $this->assertEmailCount(1);
        $this->assertEmailAddressContains($this->getMailerMessage(0), 'to', 'johndoe@email.com');
        $this->getResource('/api/authors/1', [], [
            'validateResponse'     => true,
            'validateResponseData' => ['booksCount' => 1]
        ]);

        $this->updateResource('/api/books/1', [
            'name'    => 'Mariano Rossi',
            'authors' => []
        ], ['validateResponse' => false]);
        $this->assertEmailCount(1);
        $this->assertEmailAddressContains($this->getMailerMessage(0), 'to', 'johndoe@email.com');
        $this->getResource('/api/authors/1', [], [
            'validateResponse'     => true,
            'validateResponseData' => ['booksCount' => 0]
        ]);
    }

    public function testQueryResources()
    {
        $this->getResource('/api/books', [], [
            'validateResponse'     => true,
            'validateResponseData' => [
                'hydra:member'     => [
                    ['id' => 1, 'title' => 'Title 1'],
                    ['id' => 2, 'title' => 'Title 2'],
                    ['id' => 3, 'title' => 'Title 3'],
                ],
                'hydra:totalItems' => 3
            ]
        ]);

        $this->getResource('/api/books?authors=/api/authors/2', [], [
            'validateResponse'     => true,
            'validateResponseData' => [
                'hydra:member'     => [
                    ['id' => 3, 'title' => 'Title 3'],
                ],
                'hydra:totalItems' => 1
            ]
        ]);


    }

}