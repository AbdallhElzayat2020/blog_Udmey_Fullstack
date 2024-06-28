<script type="text/javascript" src="{{ asset('frontend/assets/js/index.bundle.js') }}"></script>
@yield('js')
<script>
    $(document).ready(function () {
        // change language
        $('#site-language').on('change', function () {
            let languageCode = $(this).val();
            $.ajax({
                method: 'GET',
                url: '{{route('language')}}',
                data: {language_code: languageCode},
                success: function (data) {
                    if (data.status === 'success') {
                        window.location.reload();
                    }
                },
                error: function (data) {
                    console.error(data);
                }
            })
            // $.ajax({

            // })
        })
    })
</script>
