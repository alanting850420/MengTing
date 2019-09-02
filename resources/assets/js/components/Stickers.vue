<template>
    <div>
        <div class="vld-parent">
            <loading :active.sync="isLoading"
                     :can-cancel="false"
                     :is-full-page="fullPage"
                     :background-color="bgColor"></loading>
        </div>
        <h2>丁丁</h2>
        <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" @click="updateSticker('Ting Alan',-1)">
                  <i class="fa fa-minus"></i>
              </button>
          </span>
            <input type="text" :value="alanTingStickers" class="form-control input-number text-center" min="0" disabled>
            <span class="input-group-btn">
          <button type="button" class="btn btn-danger btn-number" @click="updateSticker('Ting Alan',1)">
            <i class="fa fa-plus"></i>
          </button>
          </span>
        </div>

        <hr style="margin-top: 32px;">

        <h2>孟庭</h2>
        <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" @click="updateSticker('Omena Omena',-1)">
                  <i class="fa fa-minus"></i>
              </button>
          </span>
            <input type="text" :value="mengTingStickers" class="form-control input-number text-center" min="0" disabled>
            <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number" @click="updateSticker('Omena Omena',1)">
                <i class="fa fa-plus"></i>
              </button>
          </span>
        </div>
    </div>
</template>

<script>
    import 'bootstrap';

    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {

        components: {
            Loading,
        },
        data() {
            return {
                alanTingStickers: 0,
                mengTingStickers: 0,
                isLoading: false,
                fullPage: true,
                bgColor: '#23405c',
            };
        },

        created() {
            this.fetchSticker();
        },

        methods: {
            fetchSticker() {
                this.isLoading = true;
                const getSticker = '/api/sticker';
                fetch(getSticker)
                    .then(res => res.json())
                    .then(data => {
                        this.alanTingStickers = data[0].counts;
                        this.mengTingStickers = data[1].counts;
                        this.isLoading = false;
                    })
                    .catch(err => console.log(err));
            },
            updateSticker(name, type) {
                this.isLoading = true;
                const getSticker = '/api/sticker';
                const body = {
                    name: name,
                    type: type,
                };
                fetch(getSticker, {
                    method: 'post',
                    body: JSON.stringify(body),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                            if (name === 'Ting Alan') {
                                this.alanTingStickers = data.Message.counts;
                            } else {
                                this.mengTingStickers = data.Message.counts;
                            }
                            this.isLoading = false;
                        }
                    )
                    .catch(err => console.log(err));
            },
        },

        mounted() {

        }
    };
</script>
