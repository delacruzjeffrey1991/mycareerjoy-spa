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
                        flat
                        class="pink darken-3">
                        <v-toolbar-title>{{ currentTitle }}</v-toolbar-title>
                        </v-toolbar>
                        <v-window v-model="step">
                            <v-window-item :value="1">
                                <v-card-text>
                                    <v-form>
                                        <v-text-field
                                        label="Email"
                                        name="email"
                                        v-model="input.email"
                                        v-validate="'required|email|max:255'"
                                        data-vv-name="email"
                                        :error-messages="errors.collect('email')"
                                        append-icon="email"
                                        type="text"
                                        ></v-text-field>
                                        <v-text-field
                                        id="password"
                                        v-model="input.password"
                                        v-validate="'required|min:8'"
                                        data-vv-name="password"
                                        :error-messages="errors.collect('password')"
                                        label="Password"
                                        name="password"
                                        :append-icon="show_password ? 'visibility' : 'visibility_off'"
                                        :type="show_password ? 'text' : 'password'"
                                        @click:append="show_password = !show_password"
                                        ></v-text-field>
                                    </v-form>
                                </v-card-text>
                            </v-window-item>
                            <v-window-item :value="2">
                        <div class="pa-4 text-center">
                            <v-img
                            class="mb-4"
                            contain
                            height="128"
                            src="https://cdn.vuetifyjs.com/images/logos/v.svg"
                            ></v-img>
                            <h3 class="title font-weight-light mb-2">Welcome to Vuetify</h3>
                           
                        </div>
                        </v-window-item>
                        </v-window>
                            <v-card-actions>
                                <v-btn
                                    :disabled="step === 1"
                                    text
                                    @click="step--"
                                    v-on:click="isHidden = false"
                                >
                                    Back
                                </v-btn>
                                <div class="flex-grow-1"></div>
                                <v-btn 
                                color="primary"
                                @click="validate"
                                v-if="!isHidden">Login</v-btn>
                                <v-btn
                                    :disabled="step === 2"
                                    text
                                    @click="step++"
                                    v-on:click="isHidden = true"
                                    v-if="!isHidden"
                                >
                                    Forgot Password?
                                </v-btn>
                            </v-card-actions>
                    </v-card>
                    <v-overlay :value="is_loading">
                        <v-progress-circular indeterminate size="64"></v-progress-circular>
                    </v-overlay>
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
            email: '',
            password: ''
        },
        show_password: false,
        is_loading: false,
        step: 1,
        isHidden: false,
    }),
    computed: {
        currentTitle () {
            switch (this.step) {
                case 1: return 'Login'
                case 2: return 'Forgot Password'
                default: return ''
            }
        }
    },
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
                const result = await AuthRepository.login(this.input);
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