<template>
    <div class="add__member">

        <div class="avatar__upload">
            <div class="avatar__edit"  @change="onFileChange">
                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload"></label>
            </div>
            <div class="avatar__preview">
                <div id="imagePreview" v-if="url" :style="{ backgroundImage: `url('${url}')`}"></div>
                <div id="imagePreview" v-else :style="{ backgroundImage: 'url(' + this.$public + 'person-placeholder.jpg' + ')' }"></div>
                <!-- <img v-if="url" :src="url" /> -->
            </div>
        </div>
        
        <section class="main__login main__register--form">
            <div class="main__login-container register__small--container d__flex d__flex-v-center d__flex-h-between">
                <div class="login__form-container">
                    <form action="">
                        <div class="full__nameHolder">
                            <fieldset class="w__50 login__fields name__field--first d__flex">
                                <label for="login__name--first">First name*</label>
                                <div class="input__wrapper">
                                    <input type="text" id="login__name--first" placeholder="e.g. Deavid">
                                </div>
                            </fieldset>
                            <fieldset class="w__50 login__fields name__field--last d__flex">
                                <label for="name__field--last">Last name*</label>
                                <div class="input__wrapper">
                                    <input type="text" id="name__field--last" placeholder="e.g. Michael">
                                </div>
                            </fieldset>
                        </div>
                        <fieldset class="login__fields email__field d__flex">
                            <label for="login__email">Email*</label>
                            <div class="input__wrapper">
                                <input type="email" id="login__email" placeholder="youremail@mail.com">
                            </div>
                        </fieldset>
                        <fieldset class="login__fields phone__field d__flex">
                            <label for="login__phonr">Phone*</label>
                            <div class="input__wrapper">
                                <input type="tel" id="login__phonr" placeholder="phone number">
                            </div>
                        </fieldset>
                        <fieldset class="login__fields name__field d__flex">
                            <label for="login__password">Password</label>
                            <div class="input__wrapper">
                                <input type="password" id="login__password" placeholder="at least 8 charcters">
                                <button id="show_password" class="eye_icon">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                                <button id="hide_password" class="eye_icon hide__this" style="">
                                    <i class="fa-regular fa-eye-slash"></i>
                                </button>
                            </div>
                        </fieldset>
                        <button @click.prevent="showDeleteModal" class="submit__btn red__border-btn">
                            Deactivate Account
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <Modal :show="isDeleteModalVisible" v-slot:modal-content>
        <template v-if="showDeleteModalContent">
            <div class="popup__icon" style="text-align: center;">
            <img src="@/assets/images/talent-images/delete-first.png" alt="delete-first">
            </div>
            <h2 class="text__center fw__700">Are you Sure you want <br>to Delete Account ?</h2>
            <div class="two__btnHolders">
                <a class="delete__buttons red__border" @click="showExperience">Yes, Delete</a>
                <a class="delete__buttons submit__btn" @click.prevent="hideDeleteModal">No, Keep</a>
            </div>
        </template>

        <template v-if="showDeleteExpirence">
            <h3 class="text__center fw__700">How Would you Rate your Experience with Us? <span class="star-req">*</span></h3>
            <div class="review__Points">
                <form action="">
                    <div class="points__wrapper d__flex">
                        <fieldset>
                            <input type="radio" name="point" id="point__1">
                            <label for="point__1">1</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="point" id="point__2">
                            <label for="point__2">2</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="point" id="point__3">
                            <label for="point__3">3</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="point" id="point__4">
                            <label for="point__4">4</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="point" id="point__5">
                            <label for="point__5">5</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" checked="" name="point" id="point__6">
                            <label for="point__6">6</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="point" id="point__7">
                            <label for="point__7">7</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="point" id="point__8">
                            <label for="point__8">8</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="point" id="point__9">
                            <label for="point__9">9</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="point" id="point__10">
                            <label for="point__10">10</label>
                        </fieldset>
                    </div>
                    <h3>We’re sprry to see you go, please tell us why you’re leaving.</h3>
                    <fieldset>
                        <textarea></textarea>
                    </fieldset>
                </form>
            </div>
            <div class="two__btnHolders">
                <a class="delete__buttons submit__btn" @click.prevent="showComplete" >Submit</a>
                <a class="delete__buttons red__border" @click.prevent="hideDeleteModal">Cancel</a>
            </div>
        </template>
        <template v-if="showDeleteComplete">
            <div class="popup__icon" style="text-align: center;">
                    <img src="@/assets/images/talent-images/delete-first.png" alt="delete-first">
            </div>
                <h3 class="text__center fw__700 text__center" style="margin: 20px 0;">Sorry to see you go! <br>We hope you enjoyed Chirrrp</h3>
                <div class="two__btnHolders">
                    <a class="delete__buttons red__border max__100" href="#">Deactivate account</a>
            </div>
        </template>
    </Modal>
</template>
<script>

    import Modal from '@/components/Modal.vue'
    export default{
        name: 'PageProfileSettings',
        components: {
            Modal
        },
        data(){
            return{
                isDeleteModalVisible: false,
                showDeleteExpirence: false,
                showDeleteComplete: false,
                showDeleteModalContent: true,
                url: null,
            }
        },
        methods:{   
            showDeleteModal(){
                this.isDeleteModalVisible = true;
            },
            hideDeleteModal(){
                this.isDeleteModalVisible = false;
                this.showDeleteExpirence = false;
                this.showDeleteModalContent = true;
            },
            showExperience(){
                this.showDeleteExpirence = true;
                this.showDeleteModalContent = false;
            },
            showComplete(){
                this.showDeleteExpirence = false;
                this.showDeleteModalContent = false;
                this.showDeleteComplete = true;
            },
            onFileChange(e) {
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
            }
        }
    }
</script>


<style scoped>
 textarea {
    max-width: 100%;
    width: 100%;
    resize: none;
    border: 1px solid #C7C7C7;
    border-radius: 10px;
    font-family: "Roboto";
    font-weight: 400;
    font-size: 16px;
    line-height: 20px;
    color: var(--black-color);
    min-height: 276px;
    margin: 22px 0;
    padding: 15px;
}
*{
    text-align: left;
}
h3.text__center{
    text-align: center !important;
}
</style>