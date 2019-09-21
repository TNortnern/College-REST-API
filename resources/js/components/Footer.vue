<template>
    <div class="footer-shell">
        <div class="link-section">
            <div class="link-group">
                <p class="footer-text">&copy; 2019 University of Greater Ontario</p>
                <a class="footer-link" href="javascript:void(0);">Terms</a> 
                <a class="footer-link" href="javascript:void(0);">Contact</a> 
            </div>
            <div class="link-group right">
                <a class="footer-link right" href="javascript:void(0);">accreditation</a> 
                <a class="footer-link right" href="javascript:void(0);">Privacy Policy</a> 
                <a class="footer-link right" href="javascript:void(0);">Security</a> 
            </div>
        </div>
        <div class="credits-block">
            <div class="credit-group main">
                <p class="credit-titles">Lead Frontend and Backend Engineer</p>
                <a href="http://trayvonnorthern.com/" target="_blank"><p class="credit-names">Trayvon Northern</p></a>
            </div>
            <div class="credit-group">
                <p class="credit-titles">Assistant Frontend Engineer</p>
                <a href="https://christopher-baunach.netlify.com/" target="_blank"><p class="credit-names">Christopher Baunach</p></a>
            </div>
            <div class="credit-group">
                <p class="credit-titles">Design Team</p>
                <p class="credit-names">Zafusi</p>
                <p class="credit-names">Balsalife</p>
            </div>
        </div>
    </div>
</template>

<script>
    import './../../sass/footer.scss'
    
    export default {
        name: "globalFooter",
        mounted() {
           
            console.log($("meta[name=login-status]").attr("content"));
        }
    }
</script>