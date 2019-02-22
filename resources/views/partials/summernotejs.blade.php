<meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Styles -->
    {{--  <link href="/css/app.css" rel="stylesheet">  --}}
    <link href="{{ url('css/summernote.css')}}" rel="stylesheet">
        <style>
        .cover{
            background-size: cover;
        }
    </style>
    <!-- Scripts -->
  {{--  <script src="/js/jquery.js"></script>
    <script src="/js/popper.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/summernote.js"></script> --}}
    <script src="{{ url('js/jquery.js')}}"></script>
    <script src="{{ url('js/popper.js')}}"></script>
    <script src="{{ url('js/bootstrap.js')}}"></script>
    <script src="{{ url('js/summernote.js')}}"></script> 
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token() ]); ?>

            var jQuery1 = $.noConflict(true);
            /* setup rich text editor */
    </script>
    @if(isset($chapter->notes))
    <script>
    jQuery1('#notes_editor').html( `<?php echo ($chapter->notes);?> `);
    </script>
    @endif
            <script>
            
             jQuery1('#notes_editor').summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true,
                
                theme:'default'
            });

            /*
             * get notes from rich text editor
             * add notes to a hidden input
             */
            function addNotes(){
                var notes =jQuery1('<input>').attr({
                    type: 'hidden',
                    value: jQuery1('#notes_editor').summernote('code'),
                    name: 'notes'
                })

                jQuery1('#chapter_form').append(notes);
            }

            /*
             * prevent form from submit
             * append hidden input to the form
             * submit the form
             */
           jQuery1('#chapter_form').submit(function (event) {
                event.preventDefault();
                addNotes();
                this.submit();
            });

            

        </script>

