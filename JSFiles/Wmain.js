const submenuData = {
  furniture: {
    title: "Furniture",
    description: "See all our furniture",
    items: [
      { name: "Sofas", img: "../Images/sofa-image.webp" },
      { name: "Chairs", img: "../Images/Chairs-img.jpg" },
      { name: "Tables", img: "../Images/Tables-img.jpg" },
      { name: "Storage", img: "../Images/Stg-img.jpg" },
      { name: "Beds", img: "../Images/Room-image1.png" },
      { name: "Outdoor", img: "../Images/Outdoor-img.jpg" }
    ]
  },
  collections: {
    title: "Collections",
    description: "Explore curated collections",
    items: [
      { name: "Sofas Collections", img: "../Images/sofa-image.webp" },
      { name: "Chairs Collections", img: "../Images/Chairs-img.jpg" },
      { name: "Tables Collections", img:"../Images/Tables-img.jpg"  },
      { name: "Storage Collections", img: "../Images/Stg-img.jpg"  },
      { name: "Accessories Collections", img: "../Images/acc-collection.jpg"    },
      { name: "Fabric and Leather Collections", img: "../Images/fea-lea.jpg"  }
    ]
   
  },
  outlet: {
    title: "Outlet",
    description: "Discounted pieces with high quality",
    items: [
      { name: "Sofa Outlet", img: "" },
      { name: "Chair Deals", img: "" },
      { name: "Table Outlet", img: "" }
    ]
  },
  rooms: {
    title: "Rooms",
    description: "Design by space",
    items: [
      { name: "Living Room", img: "../Images/Room-image1.png" },
      { name: "Dining Room", img: "../Images/Room-image2.jpg" },
      { name: "Bedroom", img: "../Images/Room-image3.jpg" }
    ]
  }
};

function toggleMenu() {
  document.getElementById("sideMenu").classList.toggle("open");
  document.getElementById("submenu").classList.remove("open");
}

function openSubMenu(section) {
  const submenu = submenuData[section];
  document.getElementById("submenu-title").textContent = submenu.title;
  document.getElementById("submenu-description").textContent = submenu.description;

  const list = document.getElementById("submenu-items");
  list.innerHTML = "";
  submenu.items.forEach(item => {
    const li = document.createElement("li");
    li.innerHTML = `<img src="${item.img}" alt="${item.name}"><span>${item.name}</span>`;
    list.appendChild(li);
  });

  document.getElementById("submenu").classList.add("open");
}



function closeSubMenu() {
  document.getElementById("submenu").classList.remove("open");
}

