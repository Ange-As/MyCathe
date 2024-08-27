<script>
export default {
    data() {
        return {
            loading: false,
            data: {
                email: "",
                password: "",
            },
        };
    },
    methods: {
        async handleSubmit() {},
    },
};
</script>

<template>
    <form class="user" @submit.prevent="handleSubmit">
        <div class="form-group">
            <input
                type="email"
                class="form-control form-control-user"
                id="exampleInputEmail"
                placeholder="Entrer votre adresse email..."
                required
                v-model="data.email"
            />
        </div>
        <div class="form-group">
            <input
                type="password"
                class="form-control form-control-user"
                id="exampleInputPassword"
                placeholder="Mot de passe"
                required
                v-model="data.password"
            />
        </div>
        <button class="btn btn-primary btn-user btn-block" type="submit">
            Se connecter
        </button>
    </form>
</template>
