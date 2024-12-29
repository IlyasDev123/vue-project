<template>
    <div class="cv__block m__lr-auto">
        <div class="cv__block-container">
            <div class="cv__block-content">

                <div class="cv__block-header">
                    <h2>Albert <br> Michaels</h2>
                    <p>Marketing Manager</p>
                </div>
                <div class="cv__block-body">

                    <div class="cv__block-item">
                        <h3 class="cv__block-heading">Education</h3>
                        <div class="cv__block-info">
                            <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
                            <p><b>School Name.</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat vero qui cupiditate perspiciatis exercitationem? Molestias minus expedita</p>
                        </div>
                        <div class="cv__block-info">
                            <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
                            <p><b>School Name.</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat vero qui cupiditate perspiciatis exercitationem? Molestias minus expedita</p>
                        </div>
                    </div>
                    <div class="cv__block-item">
                        <h3 class="cv__block-heading">Work Experience</h3>
                        <div class="cv__block-info">
                            <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
                            <p><b>School Name.</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat vero qui cupiditate perspiciatis exercitationem? Molestias minus expedita</p>
                        </div>
                        <div class="cv__block-info">
                            <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
                            <p><b>School Name.</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat vero qui cupiditate perspiciatis exercitationem? Molestias minus expedita</p>
                        </div>
                    </div>
                    <div class="cv__block-item">
                        <h3 class="cv__block-heading">Contact</h3>
                        <ul class="cv__block-list">
                            <li>Year, Month/Day</li>
                            <li>Your City,Country</li>
                            <li>123-456-789</li>
                            <li>youremail@domain.com</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="two__btns_wrapper">
        <button class="blue__bg-btn under__buttons">
            Request an Interview
        </button>
        <button class="red__btnOutline under__buttons">
            No Longer Interested
        </button>
    </div>
</template>
<script>
    import CVBlock from '@/components/CVBlock.vue';
    export default{
        name: 'PageCompaniesProfile'
    }    
</script>
<style scoped>
.m__lr-auto{
    margin-left: auto;
    margin-right: auto;
}
    .under__buttons{
        padding: 12px 42px;
        border-radius: 5px;
        font-family: roboto;
        font-size: 16px;
        line-height: 20px;
        text-align: center;
        display: inline-block;
        background: none;
        border: none;
        transition: all 0.4s ease;
    }
    .red__btnOutline{
        border: 1px solid #E75C2A;
        color: #E75C2A;
    }
    .red__btnOutline:hover{
        background: #E75C2A;
        color: #fff;
    }
    .blue__bg-btn{
        color: #fff;
        border: 1px solid #4294FF;
        background: #4294FF;
    }
    .blue__bg-btn:hover{
        background-color: transparent;
        color: #4294FF;
    }
    .two__btns_wrapper{
        text-align: center;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }
</style>