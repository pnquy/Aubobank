<div class="footer">
    <span>Product by Web2M (Fute) - v3.1.0</span>
    <a href="#">Chính sách bảo mật</a>
</div>
</div>
</div>
</div>

<!-- Vite JavaScript -->
@vite('resources/js/app.js')

<script type="text/javascript">
    document.querySelectorAll('.menu1').forEach(menu => {
        menu.addEventListener('click', function() {
            let drop = this.nextElementSibling;
            if (drop && drop.classList.contains('drop')) {
                drop.classList.toggle('show');
                drop.style.maxHeight = drop.style.maxHeight ? null : drop.scrollHeight + "px";
            }
        });
    });
</script>
</body>

</html>