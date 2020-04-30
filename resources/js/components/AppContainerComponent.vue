<template>
    <v-app id="inspire">
        <v-navigation-drawer  v-model="drawer" :clipped="$vuetify.breakpoint.lgAndUp" app>
            <v-list dense>
                <template v-for="item in items">
                    <v-row v-if="item.heading" :key="item.heading" align="center">
                        <v-col cols="6">
                            <v-subheader v-if="item.heading">
                                {{ item.heading }}
                            </v-subheader>
                        </v-col>
                        <v-col cols="6" class="text-center" >
                            <a href="#!" class="body-2 black--text">EDIT</a>
                        </v-col>
                    </v-row>
                    
                    <v-list-group v-else-if="item.children" :key="item.text" v-model="item.model" :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="" >
                        <template v-slot:activator>
                            <v-list-item-content>
                                <v-list-item-title>{{ item.text }}</v-list-item-title>
                            </v-list-item-content>
                        </template>
                        <v-list-item v-for="(child, i) in item.children" :key="i" link>
                            <v-list-item-action v-if="child.icon">
                                <v-icon>{{ child.icon }}</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                            <v-list-item-title>{{ child.text }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>
                    <v-list-item v-else-if='item.click_salir' :key="item.text" link @click='salir'>                        
                        <v-list-item-action> <v-icon>{{ item.icon }}</v-icon> </v-list-item-action>
                        <v-list-item-content> <v-list-item-title> {{ item.text }} </v-list-item-title> </v-list-item-content>
                    </v-list-item>
                    <v-list-item v-else :key="item.text" link @click='salir'>                        
                        <v-list-item-action> <v-icon>{{ item.icon }}</v-icon> </v-list-item-action>
                        <v-list-item-content> <v-list-item-title> {{ item.text }} </v-list-item-title> </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" app color="blue darken-3" dark >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
                <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
                    <span class="hidden-sm-and-down">Surcoestudios</span>
                </v-toolbar-title>
            
            <v-spacer />
            <span class=".font-weight-bold">Cristiam Monsalve</span>            
            <v-btn icon> <v-icon>mdi-bell</v-icon> </v-btn>            
        </v-app-bar>
        <v-content>
            <v-container class="fill-height" fluid>
                xxxxxxx
            </v-container>
        </v-content>
        <v-btn bottom color="pink" dark fab fixed right @click="dialog = !dialog"><v-icon>mdi-plus</v-icon></v-btn>
        <v-dialog v-model="dialog" width="800px">
            <v-card>
                <v-card-title class="grey darken-2">Create contact</v-card-title>
                <v-container>
                    <v-row class="mx-2">
                        <v-col class="align-center justify-space-between" cols="12">
                            <v-row align="center" class="mr-0" >
                                <v-avatar size="40px" class="mx-3" >
                                    <img src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png" alt="" >
                                </v-avatar>
                                <v-text-field placeholder="Name"/>
                            </v-row>
                        </v-col>
                    <v-col cols="6">
                        <v-text-field prepend-icon="mdi-account-card-details-outline" placeholder="Company" />
                    </v-col>
                    <v-col cols="6"> <v-text-field placeholder="Job title"/> </v-col>
                    <v-col cols="12">
                        <v-text-field prepend-icon="mdi-mail" placeholder="Email" />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field type="tel" prepend-icon="mdi-phone" placeholder="(000) 000 - 0000" />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field prepend-icon="mdi-text" placeholder="Notes"/>
                    </v-col>
                </v-row>
                </v-container>
                    <v-card-actions>
                        <v-btn text color="primary">More</v-btn>
                        <v-spacer />
                        <v-btn text color="primary" @click="dialog = false" >Cancel</v-btn>
                        <v-btn text @click="dialog = false" >Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-app>
    </template>
    <!--

{
          icon: 'mdi-chevron-up',
          'icon-alt': 'mdi-chevron-down',
          text: 'Labels',
          model: true,
          children: [
            { icon: 'mdi-plus', text: 'Create label' },
          ],
        },

     -->
<script>
    
  export default {
    props: {
      source: String,
    },
    data: () => ({
      dialog: false,
      drawer: null,
      items: [
        { icon: 'mdi-account-card-details', text: 'Estudiantes' },        
        { icon: 'mdi-clipboard-text', text: 'Inscripciones' },
        { icon: 'mdi-teach', text: 'Tutores' },
        { icon: 'mdi-folder-multiple', text: 'Cursos' },
        { icon: 'mdi-factory', text: 'Empresas' },        
        { icon: 'mdi-account-circle', text: 'Mi cuenta' },        
        { icon: 'mdi-contacts', text: 'Usuarios' },
        { icon: 'mdi-settings', text: 'Configuraciones' },
        { icon: 'mdi-exit-to-app', text: 'Salir', click_salir:'alerta' },
      ],
    }),
    methods: {
        salir(){
            axios.post('/logout')
            .then( response => {
               window.location.href = 'login' ;
            });
        },
        nada(){
            alert('nada')      ;
        }
    },
  }
</script>