<?php
// loan.php - Endpoint pentru gestionarea împrumuturilor de cărți

require_once __DIR__ . '/controllers/LoanController.php';

$loanController = new LoanController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Obține detaliile unui împrumut
        $loan = $loanController->getLoan($_GET['id']);
        echo json_encode($loan);
    } else {
        // Listează toate împrumuturile
        $loans = $loanController->listLoans();
        echo json_encode($loans);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Creează un nou împrumut
    $data = json_decode(file_get_contents('php://input'), true);
    $result = $loanController->addLoan(
        $data['user_id'],
        $data['book_id'],
        $data['borrow_date'],
        $data['return_date']
    );
    echo json_encode(['success' => $result]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Actualizează detaliile unui împrumut
    $data = json_decode(file_get_contents('php://input'), true);
    $result = $loanController->updateLoan(
        $data['id'],
        $data['user_id'],
        $data['book_id'],
        $data['borrow_date'],
        $data['return_date']
    );
    echo json_encode(['success' => $result]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Șterge un împrumut
    parse_str(file_get_contents('php://input'), $data);
    $result = $loanController->deleteLoan($data['id']);
    echo json_encode(['success' => $result]);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Metodă HTTP neacceptată']);
}

?>
