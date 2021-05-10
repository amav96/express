Vue.component("table-avisos", {    
    template: /*html*/
      `
          <div>
              <template>
                  <dialog-detail-notice
                      :detailNotice="detailNotice"
                      @openDialog="detailNotice.dialog = $event"
                      :admin="admin"
                  />
              </template>
  
                  <template>
                      <message-snack
                      :snackbar="snackbar"
                      />
                  </template>
  
              <template>
                      <v-simple-table>
                          <template v-slot:default>
                          <thead>
                              <tr >
                              <th v-for="column in columns" class="text-left">
                                  {{column.text}}
                              </th>
                              </tr>
                          </thead>
                          <tbody>
                          <tr 
                          v-for="row in dataResponseDB"
                          >
                            <td></td>
                            <td>{{row.aviso}}</td>
                            <td>{{row.contacto}}</td>
                            <td>{{row.country}}</td>
                            <td>{{row.name}}</td>
                            <td>{{row.identificacion}}</td>
                            <td>{{row.latAviso}}</td>
                            <td>{{row.lngAviso}}</td>
                            
                            <td>{{row.fecha_aviso_visita}}</td>
                          </tr>
                          </tbody>
                          </template>
                      </v-simple-table>
              </template>
          </div>
      `,
          props: [
              "dataResponseDB",
              "columns",
              "url_actions",
              "admin",
              "country_admin"
          ],
          data() {
              return {
              search: "",
              alert_flag: false,
              title: "",
              snackbar: {
                  snack: false,
                  textSnack: "",
                  timeout: 2000,
              },
              detailNotice: {
                  dialog : false,
                  data : []
              }
          };
          },
          methods: {
              filterOnlyCapsText(value, search, item) {
              return (
                  value != null &&
                  search != null &&
                  typeof value === "string" &&
                  value.toString().toLocaleUpperCase().indexOf(search) !== -1
              );
              },
              showDialog(item) {
              this.$emit("childrenDialog", true);
  
              this.$emit("childrenBodyDialogTemplate", item);
              },
              closedDialogOutSide() {
              // This closes the dialog when clicking outside of its container.
              this.$emit("childrenDialog", false);
              },
              openDialogSendInvoice(bool, data) {
              this.sendInvoice.data = data;
              this.sendInvoice.dialog = bool;
              this.sendInvoice.title = "Enviar remito";
              },
              openDialogDetailNotice(bool, data){
                  this.detailNotice.dialog = bool;
                  this.detailNotice.data = data;
              },
          },
          computed: {
              headers() {
              return this.columns;
              },
          },
         
  });