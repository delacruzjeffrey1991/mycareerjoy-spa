<template>
    <auth-layout>
        <v-container 
        fluid
        fill-height
        >
            <v-row 
            justify="center"
            align="center"
            >
                <v-col
                cols="12"
                sm="8"
                md="4">
                    <v-card class="elevation-12">
                        <v-toolbar
                        color="primary"
                        dark
                        flat>
                            <v-toolbar-title>Reset Password</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-form>
                                <v-text-field
                                v-model="email"
                                label="Email"
                                name="email"
                                append-icon="email"
                                type="text"
                                ></v-text-field>
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <div class="flex-grow-1"></div>
                            <v-btn color="primary">Send Password Reset Link</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </auth-layout>
</template>
<script>
import AuthLayout from 'Layouts/Auth.vue';

export default {
    components: {
        AuthLayout
    },
    data: () => ({
        email: ''
    })
}
</script>
<style>

</style>