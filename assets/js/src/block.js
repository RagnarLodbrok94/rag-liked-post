import * as topPosts from './top-posts/index.js';
import * as newPosts from './block-example/index.js';

const {
  registerBlockType,
} = wp.blocks;

let blocks = [topPosts, newPosts];

blocks.forEach(block => {
  const { metadata, settings } = block;
  const { name } = metadata;

  registerBlockType(
    name,
    {
      ...metadata,
      ...settings,
    },
  );
});