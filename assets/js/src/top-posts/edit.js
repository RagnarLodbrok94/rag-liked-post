const { __ } = wp.i18n;
const ServerSideRender = wp.serverSideRender;
const { useBlockProps } = wp.blockEditor;

const EditTopPosts = (props) => {
  const blockProps = useBlockProps();

  return (
    <div {...blockProps}>
      <ServerSideRender
        block={props.name}
        attributes={props.attributes}
      />
    </div>
  );
};

export default EditTopPosts;