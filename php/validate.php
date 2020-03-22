<?php


class validate_email {

    private $accepted_domain;

    public function __construct() {
        // Set the accepted domains property
        $this->accepted_domain = 'buffalo.edu';
    }


    public function validate_by_domain($email_address) {

        $domain = $this->get_domain( trim( $email_address ) );

        if ( $domain == $this->accepted_domain  ) {
            return true;
        }

        return false;
    }


    private function get_domain($email_address) {
        // Check if a valid email address was submitted
        if ( ! $this->is_email( $email_address ) ) {
            return false;
        }

        // Split the email address at the @ symbol
        $email_parts = explode( '@', $email_address );

        // Pop off everything after the @ symbol
        $domain = array_pop( $email_parts );

        return $domain;
    }

    private function is_email($email_address) {
        // Filter submitted value to see if it's a proper email address
        if ( filter_var ( $email_address, FILTER_VALIDATE_EMAIL ) ) {
            return true;
        }

        return false;
    }
}