<template>
  <div>
    <v-app-bar
        light
        color="grey" class="grey lighten-3"
        flat
    >
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      
      <v-toolbar-title>NavBar</v-toolbar-title>

      <div class="flex-grow-1"></div>
      <v-btn icon class="mr-10" >
        <v-badge
          color="info"
          class="align-self-center "
        >
        <template v-slot:badge>
          <span>!</span>
        </template>
        <v-icon
          color="grey--text"
          class=""
        >
          mail
        </v-icon>
        </v-badge>
      </v-btn>
      <v-btn
      color='grey--text'>
        <span>Log Out</span>
        <v-icon> exit_to_app</v-icon>
      </v-btn>
    </v-app-bar>

    <v-navigation-drawer flat app v-model="drawer" :clipped="clipped" light color="grey" class="grey lighten-3">
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title">
            My CareerJoy
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <!-- <v-divider></v-divider> -->
      <div class="container">
        <v-list>
          <v-list-item-group>
            <v-list-item 
             
              v-for="(item, i) in items"
              :key="i"
            
              v-slot:default="{ active, toggle }"
              @click="toggle"
              :class="active ? 'side' : ''"
              
            
              >
              <v-list-item-icon>
                <v-icon v-text="item.icon" :color="active ? 'error' : ''"></v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title :class="!active ? 'grey--text bold' : ''" v-text="item.text"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
          <!-- <v-list-group
            v-for="item in items"
            :key="item.title"
            v-model="item.active"
            :prepend-icon="item.action"
            no-action
            class="success--text"
            >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title v-text="item.title"></v-list-item-title>
              </v-list-item-content>
            </template>

            <v-list-item v-for="subItem in item.items" :key="subItem.title" router :to="subItem.route" v-on="on">
              <v-list-item-content>
                <v-list-item-title v-text="subItem.title"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group> -->
          
        </v-list>
      </div>
      
      
    </v-navigation-drawer>
  </div>
</template>

<script>
export default {
    data () {
      return {
        drawer: null,
        clipped: false,
      
        items: [
          { text: 'Dashboard', icon: 'dashboard', link: '/dashboard'},
         
        ],
      }
    }
  }
</script>

<style scoped>
  .side {
    border-left: 3px solid #f83e70;
    text-decoration: none;
  }
</style>

