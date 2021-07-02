Vue.component('header-admin', {
    template: //html 
        `
        <div>
            <v-row  
            class="bg-blue-custom justify-center align-items-center  flex-column m-0 py-2"
            wrap
            > 
                <v-container  class=" d-flex justify-center flex-column">
                    <h5 class=" color-white-custom text-center" >{{title}}</h5>
                    <v-toolbar 
                        elevation="0"
                        color="transparent"
                        class="d-flex justify-center flew-row "
                        height="auto"
                        wrap
                        > 
                        <div class="d-flex justify-center flex-row flex-wrap" >
                        <div  
                            v-for="item in MAINRESOURCES.itemsButtons"
                            :key="item.title"
                            link
                            >
                            <v-btn
                            @click="handle_function_call(item.methods)"
                            class="bg-blue-custom mx-3 my-1 noUpperCase"
                            color="transparent"
                            :class="[item.active? 'secondary' :  item.color]"
                            >
                            <span class="color-white-custom" >{{ item.title }}</span>
                            <v-icon class="mx-1" color="white" >{{ item.icon }}</v-icon>
                            </v-btn>
                            <v-spacer></v-spacer>
                        </div>
                        </div>
                    </v-toolbar>
                </v-container>     
            </v-row>
        </div>
        
        `,
    props: ['MAINRESOURCES', 'title'],
    methods: {
        handle_function_call(function_name) {
            this.$emit("handle_function_call", function_name)
        },
    }
})