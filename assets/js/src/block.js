import * as topPosts from './top-posts/index.js';
import * as blockExample from './block-example/index.js';

const {
  registerBlockType,
} = wp.blocks;

let blocks = [topPosts, blockExample];

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