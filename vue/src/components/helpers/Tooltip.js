Vue.component('tooltip', {
    template: //html 
        `<div>
        <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
                <slot></slot>
            </template>
            <span>textp</span>
        </v-tooltip>
    </div>
    `,
    data() {
        return {

        }
    },
    methods: {

    }
})