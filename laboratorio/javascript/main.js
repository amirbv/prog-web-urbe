
var exampleModal = document.getElementById( 'resultModal' );

if ( exampleModal != null ) {

  exampleModal.addEventListener( 'show.bs.modal', function ( event ) {

    // Button that triggered the modal
    let button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    let recipient = button.getAttribute( 'data-bs-id' );
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    let modalBodyInput = exampleModal.querySelector( 'input[name="id"]' );

    modalBodyInput.value = recipient;
  });

  exampleModal.addEventListener( 'hide.bs.modal', function ( event ) {

    let modalBodyInput = exampleModal.querySelector( 'input[name="id"]' );
    modalBodyInput.value = '';
  });
}
