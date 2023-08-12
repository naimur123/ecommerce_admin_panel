              </div>
          </div>
          {{-- <button class="btn btn-dark d-md-none" id="sidebarCollapse">
            <ion-icon name="menu-outline"></ion-icon>
          </button> --}}
</div>


<script src="{{ asset('custom/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- Summer Note --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
{{-- Datatable --}}
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.js"></script>
 {{-- ionicon --}}
 <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
 <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

 <script>
    $(document).ready(function() {
      $('.navbar-toggler[aria-controls="sidebarCollapse"]').click(function() {
        $('.sidebar').toggleClass('show');
      });
    });
 
 </script>
 
 {{-- sweetalert --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
 @include('sweetalert::alert')
</body>

</html>