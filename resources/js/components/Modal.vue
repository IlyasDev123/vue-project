<template>
    <section v-show="show" class="delete__popup overflow-popup" id="pop__1">
        <!-- <div class="overflow-popup"> -->
        <div class="popup__MainWrapper">
            <div class="popup__content">
                <slot name="modal-content"></slot>
            </div>
        </div>
    <!-- </div> -->
    </section>
</template>
<script>
    export default {
        props: {
            show: {
            type: Boolean,
            default: false
            },
        },
        name: 'DeleteMOdal'
    }
</script>
<style scoped>
.overflow-popup{
 overflow-y:auto;
 padding:20px 0;
 /* max-width:515px; */
 width:100%;
 height:100vh;
}
</style>