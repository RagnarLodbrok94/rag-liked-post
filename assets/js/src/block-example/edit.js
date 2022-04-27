const { __ } = wp.i18n;

const {
  useBlockProps,
  RichText,
  BlockControls,
  AlignmentToolbar,
  ColorPalette,
  InspectorControls,
} = wp.blockEditor;

const EditTopPosts = ({ attributes, setAttributes }) => {
  const blockProps = useBlockProps();

  const onChangeContent = (newContent) => {
    setAttributes({ content: newContent });
  };

  const onChangeAlignment = (newAlignment) => {
    setAttributes({
      alignment: newAlignment === undefined ? 'none' : newAlignment,
    });
  };

  const onChangeBGColor = (hexColor) => {
    setAttributes({ bg_color: hexColor });
  };

  const onChangeTextColor = (hexColor) => {
    setAttributes({ text_color: hexColor });
  };

  return (
    <div {...blockProps}>
      <InspectorControls key="setting">
        <div id="top-posts-controls">
          <fieldset>
            <legend className="blocks-base-control__label">
              {__('Background color', 'top-posts')}
            </legend>
            <ColorPalette
              onChange={onChangeBGColor}
            />
          </fieldset>
          <fieldset>
            <legend className="blocks-base-control__label">
              {__('Text color', 'top-posts')}
            </legend>
            <ColorPalette
              onChange={onChangeTextColor}
            />
          </fieldset>
        </div>
      </InspectorControls>
      <BlockControls>
        <AlignmentToolbar
          value={attributes.alignment}
          onChange={onChangeAlignment}
        />
      </BlockControls>
      <RichText
        tagName="p"
        style={{
          textAlign: attributes.alignment,
          backgroundColor: attributes.bg_color,
          color: attributes.text_color,
        }}
        value={attributes.content}
        onChange={onChangeContent}
      />
    </div>
  );
};

export default EditTopPosts;