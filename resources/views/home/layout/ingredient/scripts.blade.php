<!-- jQuery -->
<script src="{{ url('assets/js/jquery-3.6.0.min.js')}}"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        var statusModals = false;
        $('.ingredient--navBar--action--modals').click(function(e) {
            e.preventDefault();
            const modals = $(this).attr('data-modals');
            if (statusModals == false) {
                $('.div--'+modals).addClass('active');
            } else {
                $('.div--'+modals).removeClass('active');
            }
            statusModals = !statusModals;
        });
    });
</script>