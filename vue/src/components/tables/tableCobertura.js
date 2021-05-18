Vue.component("table-cobertura", {    
    template: /*html*/
      `
          <div>
                  <template>
                      <message-snack
                      :snackbar="snackbar"
                      />
                  </template>

                <template >
                   
                        <div class="my-1 d-flex justify-center" >
                            <v-btn
                                >
                                Total Registros <strong> &nbsp;{{pagination.totalCountResponse}} </strong>
                            </v-btn>
                        </div>
                    
                </template>
  
              <template>
                      <v-simple-table>
                          <template v-slot:default>
                          <thead>
                              <tr  class="bg-blue-custom">
                              <th v-for="column in columns" class="text-left text-white">
                              {{column.text}}
                              </th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr  v-for="row in table.dataResponseDB">
                                <td>{{row.postal_code}}</td>
                                <td>{{row.locate}}</td>
                                <td>{{row.province}}</td>
                                <td>{{row.home_address}}</td>
                                <td>{{row.customer_service_hours}}</td>
                                <td>{{row.name_country}}</td>
                                <td>{{row.type}}</td>
                                <td>{{row.name_assigned}}</td>
                                <td>{{row.id_user}}</td>
                                <td>{{row.created_at}}</td>
                                
                              </tr>
                          </tbody>
                          </template>
                      </v-simple-table>
              </template>
          </div>
      `,
          props: ["table","columns","url_actions","admin","country_admin","pagination"],
          data() {
              return {
              search: "",
              page: 1,
              editedItem: [],
              status: [],
              message: "",
              alert_flag: false,
              title: "",
              snackbar: {
                  snack: false,
                  textSnack: "",
                  timeout: 2000,
              },
              
          };
          },
          methods: {
              showDialog(item) {
              this.$emit("childrenDialog", true);
  
              this.$emit("childrenBodyDialogTemplate", item);
              },
              closedDialogOutSide() {
              // This closes the dialog when clicking outside of its container.
              this.$emit("childrenDialog", false);
              },
              
              openDialogEdit(bool, data) {
                  this.editedItem = data;
                 
                  this.dialogUpdate = bool;
                  this.title = "Editar equipos gestionados";
                  if (this.status.length === 0) {
                      const url = this.url_actions.status;
                      axios
                      .get(url)
                      .then((res) => {
                          if (!res.data[0].result) {
                          alertNegative("Mensaje CODIGO 53");
                          return;
                          }
                          this.status = res.data;
                      })
                      .catch((err) => {
                          console.log(err);
                      });
                  }
              },
              openDialogDelete(bool, data) {
              this.editedItem = data;
              this.dialogDelete = bool;
              this.title = "¿Estas seguro/a?";
              },
              updateRow() {
              var hoy = new Date();
              var getMinutos = hoy.getMinutes();
              var getSegundos = hoy.getSeconds();
              var getHora = hoy.getHours();
  
              if (getMinutos < 10) {
                  getMinutos = "0" + hoy.getMinutes();
              }
              if (getSegundos < 10) {
                  getSegundos = "0" + hoy.getSeconds();
              }
              if (getHora < 10) {
                  getHora = "0" + hoy.getHours();
              }
  
              var created_at =
                  hoy.getFullYear() +
                  "-" +
                  ("0" + (hoy.getMonth() + 1)).slice(-2) +
                  "-" +
                  ("0" + hoy.getDate()).slice(-2) +
                  " " +
                  getHora +
                  ":" +
                  getMinutos +
                  ":" +
                  getSegundos;
  
              const dataRequest = {
                  id_equipo: this.editedItem.id_equipo,
                  id: this.editedItem.id,
                  estado: this.editedItem.estado,
                  serie: this.editedItem.serie,
                  terminal: this.editedItem.terminal,
                  accesorio_uno: this.editedItem.accesorio_uno,
                  accesorio_dos: this.editedItem.accesorio_dos,
                  accesorio_tres: this.editedItem.accesorio_tres,
                  accesorio_cuatro: this.editedItem.accesorio_cuatro,
                  created_at,
                  id_user_update: this.admin,
              };
              const url = this.url_actions.update_management
  
              axios
                  .get(url, {
                  params: {
                      dataRequest,
                  },
                  })
                  .then((res) => {
                    if(res.data.error){
                      this.updateProperty.disabled = false
                      alertNegative("Mensaje CODIGO 51");
                      return;
                  }
  
                  this.message = "Actualizado correctamente";
                  this.alert_flag = true;
                  this.updateProperty.disabled = false
                  })
                  .catch((err) => {
                      this.updateProperty.disabled = false
                  console.log(err);
                  });
              },
              deleteRow() {
              this.deleteProperty.disabled = true
              const id = this.editedItem.id;
              const data = this.dataResponseDB;
  
              var hoy = new Date();
              var getMinutos = hoy.getMinutes();
              var getSegundos = hoy.getSeconds();
              var getHora = hoy.getHours();
  
              if (getMinutos < 10) {
                  getMinutos = "0" + hoy.getMinutes();
              }
              if (getSegundos < 10) {
                  getSegundos = "0" + hoy.getSeconds();
              }
              if (getHora < 10) {
                  getHora = "0" + hoy.getHours();
              }
  
              var created_at =
                  hoy.getFullYear() +
                  "-" +
                  ("0" + (hoy.getMonth() + 1)).slice(-2) +
                  "-" +
                  ("0" + hoy.getDate()).slice(-2) +
                  " " +
                  getHora +
                  ":" +
                  getMinutos +
                  ":" +
                  getSegundos;
  
              const url = this.url_actions.delete_management;
              const dataRequest = {
                  id,
                  created_at,
                  id_user_update: this.admin,
              };
              axios
                  .get(url, {
                  params: {
                      dataRequest,
                  },
                  })
                  .then((res) => {
                  if (!res.data.result) {
                      alertNegative("Mensaje CODIGO 50");
                      this.deleteProperty.disabled = false
                      return;
                  }
  
                  const found = data.filter((data) => data.id !== id);
                  this.$emit("updateDelete", found);
                  this.dialogDelete = false;
                  this.deleteProperty.disabled = false
                  this.snackbar.snack = true;
                  this.snackbar.textSnack = "Eliminado correctamente";
                  this.snackbar.timeout = 2500;
                  })
                  .catch((err) => {
                  console.log(err);
                  });
              },
          },
          computed: {
              headers() {
              return this.columns;
              },
             
          },
         
  });