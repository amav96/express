Vue.component('dialog-custom',{
template : //html 
    `
    <v-dialog 
      v-model="dialog"
      scrollable
      max-width="500px"
      @click:outside="handler"
      
            >
            <v-card>
              <v-card-title>
                <span class="headline">{{titleDialog}}</span>
              </v-card-title>
  
              <v-card-text>
                <v-container>
                  <v-row>
                      <v-list-item three-line>
                      <v-list-item-content>
                     
                       <v-col cols="12" lg="6"
                       v-for="(item, i) in templateDialog"
                       :key="i" >

                        <v-list-item-title
                         class="headline text-sm-body-2"
                        
                         v-text="item.text"
                         
                         >
                        </v-list-item-title>

                        <v-list-item-subtitle
                        class="headline text-caption mt-1"
                        v-text="item.value"
                        v-if="isNotObject(item)"
                        >
                        </v-list-item-subtitle>

                        <div
                      >
                        <v-btn
                        color="primary"
                        v-if="btnIsNotEmpty(item)"
                        block
                        @click="map(item)"
                        class="mt-1"
                        >
                        {{item.button}}
                        </v-btn>
                      </div>
                      </v-col> 
                      </v-list-item-content>
                    </v-list-item>
                    
                  </v-row>
                </v-container>
              </v-card-text>
  
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue darken-1"
                  text
                  v-if="actionsDialog.close.flag"
                  @click="closeDialog"
                >
                  {{actionsDialog.close.text}}
                </v-btn>
                <v-btn
                  color="blue darken-1"
                  text
                  v-if="actionsDialog.save.flag"
                >
                {{actionsDialog.save.text}}
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
    `,
    props:['dataResponseDB','dialog','bodyDialog','templateDialog','titleDialog','actionsDialog'],
    data (){
    return {
      downInner: false
    }
    },
    methods : {
      handler(event) {
        // I close the dialog by clicking outside of its container. In the current child component
        if (this.downInner === false) {
          this.$emit('childrenDialogClosed',false)
        }
        this.downInner = false;
      },
      map(item){
        // I bring the coordinates and open them in a new google maps window
        let lat = item.value.lat
        let lng = item.value.lng
        let coordinates = lat+','+lng;
        let url = "https://google.com.sa/maps/search/";
        window.open(url+coordinates, '_blank');
      },
      isNotObject(item){
       
        let result = true
        typeof item.value === 'object' ? result = false : result = true 
        return result
      },
      closeDialog(){
        this.$emit('childrenDialogClosed',false)
      },
      btnIsNotEmpty(item){
        // If the button text is not empty
        if(item.button !== ''){
              // console.log( 'estos si '+item.button)
              return true
        }else{
              // console.log('estos no '+item.button)
              return false
        }
      }
    }
   
    
  
})