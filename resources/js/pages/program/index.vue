<template>
   	<main-layout>
           <v-app>
           
                <template>
                    <v-data-table
                        :headers="headers"
                        :items="items"
                        sort-by="merchantID"
                        class="elevation-1 mt-5"
                    >
                    <template v-slot:item.status="{ item }">
                        <v-chip :color="getColor(item.status)" dark>{{ item.status }}</v-chip>
                    </template>
                        <template v-slot:top>
                        <v-toolbar flat color="white">
                            <v-toolbar-title>Programs</v-toolbar-title>
                            <v-divider
                            class="mx-4"
                            inset
                            vertical
                            ></v-divider>
                            <div class="flex-grow-1"></div>
                            <v-dialog v-model="dialog" max-width="500px">
                            <template v-slot:activator="{ on }">
                                <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                <span class="headline"></span>
                                </v-card-title>

                                <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.merchantID" label="Merchant ID"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.numVoucher" label="Name"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.status" label="Description"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.dateAdded" label="Status"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.dateAdded" label="Voucher Gateway"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                                </v-card-text>

                                <v-card-actions>
                                <div class="flex-grow-1"></div>
                                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                                </v-card-actions>
                            </v-card>
                            </v-dialog>
                        </v-toolbar>
                        </template>
                        <template v-slot:item.action="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                @click="editItem(item)"
                            >
                                edit
                            </v-icon>
                            <v-icon
                                small
                                @click="deleteItem(item)"
                            >
                                delete
                            </v-icon>
                        </template>
                        <template v-slot:no-data>
                            <v-btn color="primary" @click="initialize">Reset</v-btn>
                        </template>
                    </v-data-table>
                    </template>
            
            </v-app>
  	</main-layout>

</template>

<script>
import MainLayout from 'Layouts/Main.vue';

export default {
    components: {
        MainLayout,
    },
    data: () => ({
      dialog: false,
      headers: [
        {
          text: 'Merchant ID',
          align: 'left',
          sortable: false,
          value: 'merchantID',
        },
        { text: 'Name', value: 'name', sortable: true },
        { text: 'Description', value: 'description' },
        { text: 'Status', value: 'status' },
        { text: 'Voucher Gateway', value: 'vouchGateway' },
        { text: 'Actions', value: 'action', sortable: false },
      ],
      items: [],
      editedIndex: -1,
      editedItem: {
        merchantID: '',
        name: '',
        description: '',
        status: '',
        vouchGateway: '',
      },
      defaultItem: {
        merchantID: '',
        name: '',
        description: '',
        status: '',
        vouchGateway: '',
      },
    }),

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    methods: {
      initialize () {
        this.items = [
          {
            merchantID: '123456789',
            name: 'Sample Voucher',
            description: 'lorem ipsum dolar',
            status: 'active',
            vouchGateway: 'sample gateway',
          },
          {
            merchantID: '123456789',
            name: 'Sample Voucher',
            description: 'lorem ipsum dolar',
            status: 'in-active',
            vouchGateway: 'sample gateway',
          },
        ]
      },
        created () {
      this.initialize()
    },
        editItem (item) {
            this.editedIndex = this.items.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem (item) {
        const index = this.items.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.items.splice(index, 1)
        },

        close () {
        this.dialog = false
        setTimeout(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
        }, 300)
        },

        save () {
        if (this.editedIndex > -1) {
            Object.assign(this.items[this.editedIndex], this.editedItem)
        } else {
            this.items.push(this.editedItem)
        }
        this.close()
        },
        getColor (status) {
            if (status == 'active') return 'green'
            else return 'red'
        },
      
    },
}
</script>