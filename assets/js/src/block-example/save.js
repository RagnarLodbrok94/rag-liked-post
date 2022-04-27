const { useBlockProps, RichText } = wp.blockEditor;

const SaveTopPosts = ({ attributes }) => {
  const blockProps = useBlockProps.save();

  return (
    <div {...blockProps}>
      <RichText.Content
        tagName="p"
        style={{
          textAlign: attributes.alignment,
          backgroundColor: attributes.bg_color,
          color: attributes.text_color,
        }}
        value={attributes.content}
      />
    </div>
  );
};

export default SaveTopPosts;