<template>
    <div>
        <navbar></navbar>
        <carousel :carouselData='carouselData'></carousel>
        <div data-aos-offset="0" data-aos="fade-in" class="landing-page-shell">
            <div data-aos="fade-in-right" class="left-info-block-and-image-container">
                <div class="info-block">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <p class="highlighted-title">The One and Only</p>
                                    <br>
                                    <p class="highlighted-title">UOGO</p>
                                </td>
                            </tr>
                            <tr>
                                <td data-aos="fade">
                                    <p class="paragraph-header">A Little History</p>
                                    <p class="paragraph-text">{{ historyParagraphText }}</p>
                                </td>
                            </tr>
                            <tr data-aos="fade">
                                <td>
                                    <img src="https://images.unsplash.com/photo-1503577005093-b2cfc4b74604?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80">
                                </td>
                                <td>
                                    <img src="https://images.unsplash.com/photo-1504817343863-5092a923803e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80">
                                </td>
                            </tr>
                            <tr>
                                <td data-aos="fade">
                                    <p class="paragraph-header">Our Campus</p>
                                    <p class="paragraph-text">{{ campusParagraphText }}</p>
                                </td>
                                <td data-aos="fade">
                                    <img src="https://images.unsplash.com/photo-1527891751199-7225231a68dd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div data-aos="fade-up" class="right-image">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80">
                </div>
            </div>
            <div data-aos="fade-down" class="right-info-block-container">
                <div class="right-info-block">
                    <div class="right-info-block-title">
                        <p class="title-blue">What's</p>
                        <p class="title-black">Happening at UOGO</p>
                    </div>
                    <div class="info-cards-container">
                        <div data-aos="fade-up" class="info-card">
                            <div class="info-card-image">
                                <img src="https://images.unsplash.com/photo-1485965373059-f07657e9f841?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80">
                            </div>
                            <div class="card-body">
                                <div class="info-card-title">
                                    Engineering Department releases 50th Paper
                                </div>
                                <div class="info-card-description">
                                    {{ infoCard1Text }}
                                </div>
                                <div class="info-card-read-more-link">
                                    Read More
                                </div>
                            </div>
                        </div>
                        <div data-aos="fade-in" class="info-card">
                            <div class="info-card-image">
                                <img src="https://images.unsplash.com/photo-1558087333-5953f5994102?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80">
                            </div>
                            <div class="card-body">
                                <div class="info-card-title">
                                    'The Best Hockey in the Region'
                                </div>
                                <div class="info-card-description">
                                    {{ infoCard2Text }}
                                </div>
                                <div class="info-card-read-more-link">
                                    Read More
                                </div>
                            </div>
                        </div>
                        <div data-aos="fade-in" class="info-card">
                            <div class="info-card-image">
                                <img src="https://images.unsplash.com/photo-1496902526517-c0f2cb8fdb6a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=3900&q=80">
                            </div>
                            <div class="card-body">
                                <div class="info-card-title">
                                    Job Placement becomes Countries Best
                                </div>
                                <div class="info-card-description">
                                    {{ infoCard3Text }}
                                </div>
                                <div class="info-card-read-more-link">
                                    Read More
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="registration-modal-container">
                <div data-aos="fade" class="registration-modal">
                    <div data-aos="flip-down" class="registration-modal-form">
                        <div v-if="validationErrors != 0" class="alert alert-danger">
                        <ul>
                            <li v-for="(error, key) in validationErrors" :key="key">{{error}}</li>
                        </ul>
                        </div>
                        <form id="registration-form" @submit.prevent="register" action method="post">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input
                                            type="text"
                                            class="modal-input"
                                            placeholder="Enter First Name"
                                            v-model="firstname"
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input
                                            type="text"
                                            class="modal-input"
                                            placeholder="Enter Last Name"
                                            v-model="lastname"
                                            />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input
                                            type="text"
                                            class="modal-input"
                                            placeholder="Enter E-mail Address"
                                            v-model="email"
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input
                                            type="text"
                                            class="modal-input"
                                            placeholder="Enter Phone Number"
                                            v-model="pnum"
                                            />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input
                                            type="password"
                                            class="modal-input"
                                            placeholder="Enter Password"
                                            v-model="password"
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input
                                            type="password"
                                            class="modal-input"
                                            placeholder="Confirm Password"
                                            v-model="confirm"
                                            />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button id="loginbutton" class="button">Register</button>
                        </form>
                    </div>
                    <div class="registration-modal-contact-info">
                        <p>Register for the University of Greater Ontario</p>
                    </div>
                </div>
            </div>
             <globalFooter></globalFooter>
        </div>
    </div>
</template>

<script>
    import './../../sass/home.scss'
    import navbar from './Navbar'
    import carousel from './Carousel'
    import globalFooter from './Footer'
    
    window.axios = require("axios");
    // For adding the token to axios header (add this only one time).
    window.axios.defaults.headers.common = {
    _token: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    "X-Requested-With": "XMLHttpRequest",
    "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };

        export default {
        components: {
            navbar,
            carousel,
            globalFooter
        },
        data: function() {
            return {
                dummyText: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                demmyTextSmall: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                historyParagraphText: "For over a hundred years, University of Greate Ontario has served as a center of learning for Canada.",
                campusParagraphText: "Our Historic campus was recently restored in 2012 and is looking greater than ever before!",
                infoCard1Text: "We are proud to announce that the students of our Engineering department have released UOGOs 50th scientific paper...",
                infoCard2Text: "As our Prime Minister put it; and we can't argue with him on that after our team brought home their sixth...",
                infoCard3Text: "This year, UOGOs job placement rate for graduates surpassed 95%; the best in the country!...",
                firstname: "",
                lastname: "",
                email: "",
                password: "",
                confirm: "",
                pnum: "",
                errors: "",
                carouselData: {
                    carouselImage: [
                        'https://images.unsplash.com/photo-1549163986-da279e1f27c7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2448&q=80',
                        'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80',
                        'https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=3900&q=80',
                    ],
                    carouselText: [
                        'Set in the heart of Ontarios plains, our campus is over 100 years old, featuring beautifully aged buildings.',
                        'Our University supports the highest graduation percentage in the country at 75%.',
                        'A wealth of tutoring services supply students with everything they need to succeed.',
                    ]
                }
            }
        },
        methods: {
            register() {
            $("#page-loader").show();
            $("#loginbutton").attr("disabled", true);
            axios
                .post("/register", {
                firstname: this.firstname,
                lastname: this.lastname,
                email: this.email,
                phonenumber: this.pnum,
                password: this.password,
                password_confirmation: this.confirm
                })
                .then(res => {
                window.location.href = "/";
                })
                .catch(err => {
                    console.log(err)
                $("#page-loader").hide();
                this.errors = err.response.data.errors;
                $("#loginbutton").attr("disabled", false);
                });
            }
        },
        computed: {
            validationErrors() {
            let errors = Object.values(this.errors);
            errors = errors.flat();
            return errors;
            }
        },
        created(){
            $("#page-loader").hide();
            AOS.refreshHard();
        }
    }
</script>
