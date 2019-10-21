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
                            <v-toolbar-title>Register</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-form>
                                <v-text-field
                                label="Name"
                                name="name"
                                v-model="input.name"
                                v-validate="'required|max:255'"
                                data-vv-name="name"
                                :error-messages="errors.collect('name')"
                                append-icon="person"
                                type="text"
                                ></v-text-field>
                                <v-text-field
                                v-model="input.email"
                                v-validate="'required|email|max:255'"
                                data-vv-name="email"
                                :error-messages="errors.collect('email')"
                                label="Email"
                                name="email"
                                append-icon="email"
                                type="text"
                                ></v-text-field>
                                <v-text-field
                                v-model="input.password"
                                v-validate="'required|min:8'"
                                data-vv-name="password"
                                :error-messages="errors.collect('password')"
                                ref="password"
                                label="Password"
                                name="password"
                                :append-icon="show_password ? 'visibility' : 'visibility_off'"
                                :type="show_password ? 'text' : 'password'"
                                @click:append="show_password = !show_password"
                                ></v-text-field>
                                <v-text-field
                                v-model="input.password_confirmation"
                                v-validate="'required|confirmed:password'"
                                data-vv-as="password"
                                :error-messages="errors.collect('password_confirmation')"
                                label="Confirm password"
                                name="password_confirmation"
                                :append-icon="show_confirm_password ? 'visibility' : 'visibility_off'"
                                :type="show_confirm_password ? 'text' : 'password'"
                                @click:append="show_confirm_password = !show_confirm_password"
                                ></v-text-field>
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <div class="flex-grow-1"></div>
                            <v-btn color="primary" @click="validate">Register</v-btn>
                        </v-card-actions>
                        <v-overlay :value="is_loading">
                            <v-progress-circular indeterminate size="64"></v-progress-circular>
                        </v-overlay>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </auth-layout>
</template>
<script>
import AuthLayout from 'Layouts/Auth.vue';
import { RepositoryFactory } from 'Repositories/repositoryFactory';

const AuthRepository = RepositoryFactory.get('auth');

export default {
    inject: ['$validator'],
    components: {
        AuthLayout
    },
    data: () => ({
        input: {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        },
        show_password: false,
        show_confirm_password: false,
        is_loading: false
    }),
    methods: {
        async validate() {
            try {
                const result = await this.$validator.validateAll();
                if(result) {
                    this.is_loading = true;
                    this.submit();
                }
            } catch (error) {
                console.error(error)
            }
        },

        async submit() {
            try {
                const result = await AuthRepository.register(this.input);
                this.goToHome();
            } catch (error) {
                console.error(error);
            }
            this.is_loading = false;
        },
        goToHome() {
            return window.location.href = '/';
        }
    }
}
</script>
<style>

</style>