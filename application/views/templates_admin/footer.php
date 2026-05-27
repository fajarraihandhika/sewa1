<footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

<!-- General JS Scripts -->
 <script>
// Soft Minimalism Login Form
class SoftMinimalismLoginForm extends FormUtils.LoginFormBase {
    constructor() {
        super({
            submitButtonSelector: '.comfort-button',
            formGroupSelector: '.soft-field',
            cardSelector: '.soft-card',
            hideOnSuccess: ['.comfort-social', '.comfort-signup', '.gentle-divider'],
            validators: {
                email: FormUtils.validateEmail,
                password: (v) => {
                    if (!v) return { isValid: false, message: 'Please enter your password' };
                    if (v.length < 6) return { isValid: false, message: 'Password must be at least 6 characters' };
                    return { isValid: true };
                },
            },
        });
    }

    decorate() {
        // Soft hover lift on field containers
        [this.form.querySelector('#email'), this.form.querySelector('#password')].forEach(input => {
            if (!input) return;
            input.setAttribute('placeholder', ' ');
            input.addEventListener('focus', () => {
                const c = input.closest('.field-container');
                if (c) c.style.transform = 'translateY(-1px)';
            });
            input.addEventListener('blur', () => {
                const c = input.closest('.field-container');
                if (c) c.style.transform = 'translateY(0)';
            });
        });

        // Press effect on interactive elements
        document.querySelectorAll('.comfort-button, .social-soft, .gentle-checkbox').forEach(el => {
            el.addEventListener('mousedown', () => { el.style.transform = 'scale(0.98)'; });
            el.addEventListener('mouseup', () => { el.style.transform = 'scale(1)'; });
            el.addEventListener('mouseleave', () => { el.style.transform = 'scale(1)'; });
        });
    }
}

document.addEventListener('DOMContentLoaded', () => new SoftMinimalismLoginForm());
</script>
<script src="<?= base_url('assets/assets_admin/assets/modules/jquery.min.js') ?>"></script>

<script src="<?= base_url('assets/assets_admin/assets/modules/popper.js') ?>"></script>

<script src="<?= base_url('assets/assets_admin/assets/modules/tooltip.js') ?>"></script>

<script src="<?= base_url('assets/assets_admin/assets/modules/bootstrap/js/bootstrap.min.js') ?>"></script>

<script src="<?= base_url('assets/assets_admin/assets/modules/nicescroll/jquery.nicescroll.min.js') ?>"></script>

<script src="<?= base_url('assets/assets_admin/assets/modules/moment.min.js') ?>"></script>

<script src="<?= base_url('assets/assets_admin/assets/js/stisla.js') ?>"></script>

<!-- Page Specific JS File -->
<script src="<?= base_url('assets/assets_admin/assets/js/page/index-0.js') ?>"></script>

<!-- Template JS File -->
<script src="<?= base_url('assets/assets_admin/assets/js/scripts.js') ?>"></script>

<script src="<?= base_url('assets/assets_admin/assets/js/custom.js') ?>"></script>
    </body>
    </html>