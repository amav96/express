Vue.component('condition-btn', {
    template: //html 
        `<div :class="resources.condition.class">
            <v-btn @click="handlersCondition(property,true)" :color="condition ? resources.condition.color1 : 'blue-grey lighten-4'" :disabled="loading">
            {{resources.condition.text1}}
            </v-btn>
            <v-btn @click="handlersCondition(property,false)" :color="!condition &&  condition !== undefined? resources.condition.color2 : 'blue-grey lighten-4'"  :disabled="loading">
            {{resources.condition.text2}}
            </v-btn>
            <template  v-if="condition !== undefined ">
                <v-chip @click="handlersCondition(property,undefined)" color="warning" :disabled="loading">
                    Limpiar filtro
                    <v-icon>
                    mdi-filter-remove
                    </v-icon>
                </v-chip>
            </template>
            
        </div>
    `,
    props: ['resources', 'property'],
    mixins: [Condition],

})