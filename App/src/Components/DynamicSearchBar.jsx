/* eslint-disable react/prop-types */
import { useState } from "react";

const DynamicSearchBar = ({
  itemList,
  placeholder,
  propertyToFilter,
  display,
  onItemSelect,
}) => {
  const [searchTerm, setSearchTerm] = useState("");
  const [searchResults, setSearchResults] = useState([]);
  // const [selectedItem, setSelectedItem] = useState(null);
  const handleInputChange = (e) => {
    const term = e.target.value;
    setSearchTerm(term);
    const results = itemList.filter((item) => {
      return item[propertyToFilter]
        ?.toLowerCase()
        ?.includes(term?.toLowerCase());
    });
    setSearchResults(results);
  };

  const handleItemSelect = (item) => {
    // setSelectedItem(item);
    setSearchTerm(item);
    onItemSelect(item);
    setSearchResults([]);
  };

  return (
    <div>
      <input
        type="text"
        placeholder={placeholder}
        value={searchTerm}
        onChange={handleInputChange}
        className="input input-bordered input-info w-full"
      />
      <div className="w-full max-h-32 overflow-auto">
        {searchResults.map((item, index) => (
          <li
            key={index}
            onClick={() => handleItemSelect(item)}
            className="hover:bg-base-300 w-full list-none px-2 py-2"
          >
            {display(item)}
          </li>
        ))}
      </div>
      {/* {selectedItem && <p>Selected Item: {selectedItem}</p>} */}
    </div>
  );
};

export default DynamicSearchBar;
