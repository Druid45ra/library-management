// models/Loan.php

namespace App\Models;

class Loan
{
    private $id;
    private $userId;
    private $bookId;
    private $borrowDate;
    private $returnDate;

    public function __construct($id, $userId, $bookId, $borrowDate, $returnDate)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->bookId = $bookId;
        $this->borrowDate = $borrowDate;
        $this->returnDate = $returnDate;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getBookId()
    {
        return $this->bookId;
    }

    public function getBorrowDate()
    {
        return $this->borrowDate;
    }

    public function getReturnDate()
    {
        return $this->returnDate;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
    }

    public function setBorrowDate($borrowDate)
    {
        $this->borrowDate = $borrowDate;
    }

    public function setReturnDate($returnDate)
    {
        $this->returnDate = $returnDate;
    }
}
