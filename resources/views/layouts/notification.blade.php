
<!--Custom JavaScript -->
<script src="/plugins/toast-master/js/jquery.toast.js"></script>

@if(Session::has('message') || isset($message) && is_array($message))
    <?php $message = Session::get('message') ?: isset($message)?>
    <script>
        $(function() {
            "use strict";

            $.toast({
                heading: '{{trans('common.'.$message['type'])}}',
                text: '{{trans($message['text'])}}',
                position: 'top-left',
                loaderBg:'#ff6849',
                icon: '{{$message['type']}}',
                hideAfter: 3000,
                stack: 6
            });
        });

    </script>
@endif

