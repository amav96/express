Vue.component('d-continue', {
    template: //html 
        `
    <div :class="content.class">
        <v-card-title>
        {{content.title}}
        </v-card-title>
        <v-card-actions>
        <v-spacer></v-spacer>
            <v-btn
            :color="content.accept.color"
            @click="$continue()"
            >
            {{content.accept.title}}
            </v-btn>
            <v-btn
            :color="content.exit.color"
            @click="$exit()"
            >
            {{content.exit.title}}
            </v-btn>
        </v-card-actions>
    </div>
    `,
    props: ['content'],
    data() {
        return {

        }
    },
    methods: {
        $continue() {
            this.$emit("setContinue", true)

        },
        $exit() {
            this.$emit("setContinue", false)

        }
    }
})