<?php
require_once '../models/Ticket.php';

class TicketController
{
    private $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new Ticket();
    }


    public function index()
    {
        $tickets = $this->ticketModel->getAllTickets();
        return $tickets;
    }


    public function detail($id)
    {
        $ticket = $this->ticketModel->getTicketById($id);
        if ($ticket) {
            require_once '../views/ticket_detail.php';
        } else {
            echo "Ticket not found.";
        }
    }


    public function approve($id)
    {
        $result = $this->ticketModel->approveTicket($id);
        if ($result) {

            header("Location: manage_tickets.php?success=Ticket+approved+successfully");
            exit();
        } else {
            echo "Failed to approve ticket.";
        }
    }


    public function decline($id)
    {
        $result = $this->ticketModel->declineTicket($id);
        if ($result) {

            header("Location: manage_tickets.php?success=Ticket+declined+successfully");
            exit();
        } else {
            echo "Failed to decline ticket.";
        }
    }


    public function delete($id)
    {
        $result = $this->ticketModel->deleteTicket($id);
        if ($result) {
            header("Location: manage_tickets.php?success=Ticket+deleted+successfully");
            exit();
        } else {
            echo "Failed to delete ticket.";
        }
    }
}
