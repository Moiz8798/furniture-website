const submenuData = {
      furniture: {
        title: "Furniture",
        description: "See all our furniture",
        items: [
          { name: "Sofas", img: "assets/media/sofaimage.webp" },
          { name: "Chairs", img: "assets/media/Chairsimg.jpg" },
          { name: "Tables", img: "assets/media/Tablesimg.jpg" },
          { name: "Storage", img: "assets/media/Stgimg.jpg" },
          { name: "Beds", img: "assets/media/Roomimage1.png" },
          { name: "Outdoor", img: "assets/media/Outdoorimg.jpg" }
        ]
      },
      collections: {
        title: "Collections",
        description: "Explore curated collections",
        items: [
          { name: "Sofas Collections", img: "assets/media/sofaimage.webp" },
          { name: "Chairs Collections", img: "assets/media/Chairsimg.jpg" },
          { name: "Tables Collections", img:"assets/media/Tablesimg.jpg"  },
          { name: "Storage Collections", img: "assets/media/Stgimg.jpg"  },
          { name: "Accessories Collections", img: "assets/media/acccollection.jpg"    },
          { name: "Fabric and Leather Collections", img: "assets/media/fealea.jpg"  }
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
          { name: "Living Room", img: "assets/media/Roomimage1.png" },
          { name: "Dining Room", img: "assets/media/Roomimage2.jpg" },
          { name: "Bedroom", img: "assets/media/Roomimage3.jpg" }
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
  
  