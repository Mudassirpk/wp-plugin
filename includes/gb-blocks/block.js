const { registerBlockType } = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, TextControl } = wp.components;

// Register the block
registerBlockType("custom/vehicle-block", {
  title: "Vehicle Block",
  description: "Displays vehicle data in a custom block.",
  category: "widgets",
  icon: "car",
  attributes: {
    title: {
      type: "string",
      default: "Vehicle Information",
    },
  },

  edit: function (props) {
    const { attributes, setAttributes } = props;

    // Debugging: Confirm if this method is triggered
    console.log("Vehicle Block Edit Rendered", props);

    return wp.element.createElement(
      "div",
      { className: "vehicle-block-editor" },
      wp.element.createElement(
        InspectorControls,
        null,
        wp.element.createElement(
          PanelBody,
          { title: "Block Settings" },
          wp.element.createElement(TextControl, {
            label: "Title",
            value: attributes.title,
            onChange: function (newTitle) {
              setAttributes({ title: newTitle });
            },
          })
        )
      ),
      wp.element.createElement("h2", null, attributes.title),
      wp.element.createElement(
        "div",
        { className: "vehicle-list" },
        wp.element.createElement("p", null, "Loading vehicle data...")
      )
    );
  },

  save: function () {
    // This block will be rendered dynamically via PHP, so return null here
    return null;
  },
});
