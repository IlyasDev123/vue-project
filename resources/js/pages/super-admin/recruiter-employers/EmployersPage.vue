<template>
    
    <div class="d__flex d__flex-h-between d__flex-v-center">
        <ComponentTitle pageTitle="All Employers" />
        <Filter />

    </div>

    <div class="all__members">

        <!-- ADD New -->
        <router-link :to="{name:'AddEmployerPage'}" class="add__new d__flex d__flex-v-center">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#E24108" stroke-opacity="0.96" stroke-dasharray="5 5"/>
                <path d="M17 17V12H18.6667V17H23.6667V18.6667H18.6667V23.6667H17V18.6667H12V17H17Z" fill="#E94910" fill-opacity="0.86"/>
            </svg>
            <span>Add New</span>                                        
        </router-link>

        <TableViewOne :Listing="employers" :tableHeading="tableHeading" />

    </div>
    
</template>

<script>
import ComponentTitle from '@/components/ComponentTitle.vue'
import TableViewOne from '@/components/TableViewOne.vue';
import Filter from '@/components/Filter.vue'

    export default {
        
        components:{
            ComponentTitle,
            TableViewOne,
            Filter
        },
        data(){
            return{
                tableHeading:{
                    col1: "Name",
                    col2: "Refer By",
                    col3: "Company Name",
                    col4: "Email",
                    col5: "Status",    
                    col6: "",
                },
                
                employers: [
                    {
                        image:"user-1.png",
                        name: "Eyem McLovin",
                        refferBy: "Katie Clark",
                        companyName:"Google",
                        email:"Albertmichael@mail.com",
                        status:"Premium",
                    },
                    {
                        image:"user-1.png",
                        name: "Eyem McLovin",
                        refferBy: "Katie Clark",
                        companyName:"Google",
                        email:"Albertmichael@mail.com",
                        status:"Unpaid",
                    },
                    {
                        image:"user-1.png",
                        name: "Eyem McLovin",
                        refferBy: "Katie Clark",
                        companyName:"Google",
                        email:"Albertmichael@mail.com",
                        status:"Normal",
                    },
                ],
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>