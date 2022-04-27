# rag_liked_post

[link to TZ WP Dev](https://docs.google.com/document/d/1o-GB6jXcUa5sBNpubPEZc7HSiSWvw1xGk295Fg7_RV8/edit)

### Structure

1. The **rag-liked-post.php** file:
   * plugin registration **RagLikedPost**
   * connecting scripts and styles
   * adding a "Like" button and a counter to messages
   * Handler for clicking the Like button on the server side and saving to the database
2. The **rag-liked-post.js** file is the click handler for the Like button.
3. The **post-like.php** template is a button and counter that is inserted into each post.
4. The **assets/js/block.js** file contains the JavaScript portion of the block registration.
5. The **assets/js/top-posts/edit.js** file defines edit function.
6. The **includes/blocks.php** file registers the block type on the server side.