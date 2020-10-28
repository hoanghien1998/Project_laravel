<template>
  <div>
    <div class="container">
      <h1>
        {{ listing.carMake.name }}
        {{ listing.carModel.name }}
        {{ listing.carTrim.name }}, <span>{{ listing.year }}</span>
      </h1>
      <div class="description">
        {{ listing.description }}
      </div>
      <div>Price: <span class="price">${{ listing.price }}</span></div>
    </div>

    <div class="container">
      <b-row>
        <b-col>
          <b-img-lazy :src="main_img"
                      width="800px"
                      rounded
                      alt="Image 1"/>
        </b-col>
        <b-col>
          <b-img v-for="image in listing.medias"
                 :key="image"
                 :src="image.full"
                 center
                 thumbnail
                 style="margin-bottom: 10px"
                 alt="Center image"/>
        </b-col>
      </b-row>
    </div>

    <div class="container">
      <b-form inline>
        <b-form-input
          id="message"
          v-model="comments.message"
          placeholder="Enter your comment"
        />
        <b-button variant="primary"
                  @click="addComment">Add comment</b-button>
      </b-form>
    </div>

    <div class="container">
      <b-media v-for="comment in show_comments"
               :key="comment">
        <p class="mt-0 name">{{ comment.id }}</p>
        <p>
          {{ comment.message }}
        </p>
      </b-media>
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';

const { mapActions } = createNamespacedHelpers('listings');

export default {
  data() {
    return {
      listing:  {},
      main_img: '',
      comments: {
        object_name: 'comment',
        object_id:   1,
        message:     '',
      },
      show_comments: {},
    };
  },
  async created() {
    await this.initPage();
  },
  methods: {
    ...mapActions([ 'detailListing', 'addCommentListing', 'getCommentsListing' ]),
    async initPage() {
      const data = await this.detailListing(1);

      this.listing = data;
      this.main_img = this.listing.medias[0].full;

      const comments = await this.getCommentsListing(5);

      this.show_comments = comments;
    },
    async addComment() {
      const data = await this.addCommentListing(this.comments);
    },
  },
};
</script>

<style>
.price {
  font-weight: bold;
  font-size: 30pt;
}
.container {
  font-size: 18pt;
  margin-top: 10px;
}
.name {
  font-weight: bold;
}
</style>
