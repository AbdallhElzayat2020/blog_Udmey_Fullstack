<!-- General JS Scripts -->
<script src="{{asset('admin/assets/modules/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/modules/popper.js')}}"></script>
<script src="{{asset('admin/assets/modules/tooltip.js')}}"></script>
<script src="{{asset('admin/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('admin/assets/modules/moment.min.js')}}"></script>
<script src="{{asset('admin/assets/js/stisla.js')}}"></script>
@yield('js')
<!-- JS Libraies -->
<script src="{{asset('admin/assets/modules/summernote/summernote-bs4.js')}}"></script>
{{--secrch table--}}
<script src="{{asset('admin/assets/modules/select2/dist/js/select2.full.min.js')}}"></script><!-- Template JS File -->

<script src="{{asset('admin/assets/js/scripts.js')}}"></script>
<script src="{{asset('admin/assets/js/custom.js')}}"></script>
<script src="{{asset('admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js')}}"></script>
{{--data Table--}}
<script src="{{asset('admin/assets/modules/datatables/datatables.min.js')}}"></script>
<script src="{{asset('admin/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
{{--<script src="{{asset('admin/https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>--}}
<script src="{{asset('admin/assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>
{{--sweet Alert--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $.uploadPreview({
        input_field: "#image-upload",   // Default: .image-upload
        preview_box: "#image-preview",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Choose File",   // Default: Choose File
        label_selected: "Change File",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
    });
    // add csrf token in ajax request
    $.ajaxSetup({
        headers: {
            'X_CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // delete popup
    $(document).ready(function () {
        $('.delete-item').on('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $(this).attr("href");
                    console.log(url);
                    $.ajax({
                        method: "DELETE",
                        url: url,
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (data) {
                            console.log(data)
                        }
                    });

                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    })
</script>

