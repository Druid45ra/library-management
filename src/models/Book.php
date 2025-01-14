<?php
// book.php - Endpoint pentru gestionarea cărților

require_once __DIR__ . '/controllers/BookController.php';

$bookController = new BookController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Obține detaliile unei cărți
        $book = $bookController->getBook($_GET['id']);
        echo json_encode($book);
    } else {
        // Listează toate cărțile
        $books = $bookController->listBooks();
        echo json_encode($books);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adaugă o carte nouă
    $data = json_decode(file_get_contents('php://input'), true);
    $result = $bookController->addBook(
        $data['title'],
        $data['author'],
        $data['published_year'],
        $data['genre'],
        $data['copies']
    );
    echo json_encode(['success' => $result]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Actualizează detaliile unei cărți
    $data = json_decode(file_get_contents('php://input'), true);
    $result = $bookController->updateBook(
        $data['id'],
        $data['title'],
        $data['author'],
        $data['published_year'],
        $data['genre'],
        $data['copies']
    );
    echo json_encode(['success' => $result]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Șterge o carte
    parse_str(file_get_contents('php://input'), $data);
    $result = $bookController->deleteBook($data['id']);
    echo json_encode(['success' => $result]);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Metodă HTTP neacceptată']);
}

?>
