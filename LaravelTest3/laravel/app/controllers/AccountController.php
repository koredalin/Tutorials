<?php
// AccountController.php
class AccountController extends BaseController {
    // Reach information
    public function getCreate() {
        return View::make('account.create');
    }
    
    // Submit information
    public function postCreate() {
        return 'A Post request.';
    }
}