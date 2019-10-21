<template>
	<v-app>
        <v-content>
            <nav-main/>
        </v-content>
            <v-container class="mx-2">
                <v-content>
                    <slot/>
                </v-content>
            </v-container>
    </v-app>
</template>

<script>
import NavMain from 'Components/navigations/NavMain.vue';

export default {
    components: {
        NavMain,
    },
}
</script>