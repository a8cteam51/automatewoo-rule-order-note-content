<?php

defined( 'ABSPATH' ) || exit;

/**
 * Custom Rule: Order - Order Note
 *
 * This rule checks the content of the order notes.
 */
class AutomateWoo_Rule_Order_Note_Content extends \AutomateWoo\Rules\Rule {

    public $type = 'string'; 

    public $data_item = 'order';

    public function init() {
        $this->title = __( 'Order - Order Note Content', 'automatewoo' );
        $this->group = __( 'Order', 'automatewoo' );

        $this->compare_types = array(
            'contains'     => __( 'contains', 'automatewoo' ),
            'not_contains' => __( 'does not contain', 'automatewoo' ),
        );
    }

    public function validate( $order, $compare, $value ) {
        if ( ! $order || ! $value ) {
            return false;
        }

        // Get all order notes
        $notes = wc_get_order_notes( array( 'order_id' => $order->get_id() ) );
        
        // Check if any note contains the search text
        foreach ( $notes as $note ) {
            $note_content = strtolower( $note->content );
            $search_text = strtolower( $value );
            
            $contains = strpos( $note_content, $search_text ) !== false;
            
            if ( $compare === 'contains' && $contains ) {
                return true;
            }
            if ( $compare === 'not_contains' && $contains ) {
                return false;
            }
        }
        
        return $compare === 'not_contains';
    }
}

return new AutomateWoo_Rule_Order_Note_Content(); 
