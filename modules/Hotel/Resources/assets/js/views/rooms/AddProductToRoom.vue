<template>
    <div>
        <div class="page-header pr-0">
            <h2>
                <a href="/dashboard"><i class="fas fa-tachometer-alt"></i></a>
            </h2>
            <ol class="breadcrumbs">
                <li class="active"><span>RECEPCIÓN</span></li>
            </ol>
            <div class="right-wrapper pull-right">
                <div class="btn-group flex-wrap">
                    <button
                        class="btn btn-custom btn-sm mt-2 mr-2"
                        type="button"
                        @click="onGotoBack"
                    >
                        <i class="fa fa-arrow-left"></i> Atras
                    </button>
                </div>
            </div>
        </div>
        <div class="card mb-0">
            <div class="card-header">
                <h3 class="my-0">{{ title }}</h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <div class="text-end">
                            <el-button type="primary"
                                       @click="onOpenModalProducts">
                                <i class="fa fa-plus"></i>
                                <span class="ml-2">Agregar Producto</span>
                            </el-button>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cant.</th>
                                <th class="text-center">Precio</th>
                                <th class="text-end">Importe</th>
                                <th class="text-center">Estado del pago</th>
                                <th class="text-end"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="p in form.products"
                                :key="p.item_id">
                                <td>{{ p.item.description }}</td>
                                <td class="text-center">{{ p.quantity | toDecimals }}</td>
                                <td class="text-center">
                                    {{ p.input_unit_price_value | toDecimals }}
                                </td>
                                <td class="text-end">{{ p.total | toDecimals }}</td>
                                <td class="text-center">
                                    <div class="d-inline-block"
                                         style="max-width: 150px">
                                        <el-select
                                            v-model="p.payment_status"
                                            placeholder="Proceso de pago"
                                        >
                                            <el-option label="Cancelado"
                                                       value="PAID"></el-option>
                                            <el-option
                                                label="Cargar a habitación"
                                                value="DEBT"
                                            ></el-option>
                                        </el-select>
                                        <div
                                            v-if="errors.payment_status"
                                            class="text-danger"
                                        >
                                            {{ errors.payment_status[0] }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <el-button type="danger"
                                               @click="onDeleteProduct(p)">
                                        <i class="fa fa-trash"></i>
                                    </el-button>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot v-if="form.products.length > 0">
                            <tr>
                                <td class="text-end"
                                    colspan="3">SUBTOTAL
                                </td>
                                <td class="text-end">
                                    {{ this.form.subtotal | toDecimals }}
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-end"
                                    colspan="3">IGV
                                </td>
                                <td class="text-end">
                                    {{ this.form.igv | toDecimals }}
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-end"
                                    colspan="3">TOTAL
                                </td>
                                <td class="text-end">
                                    {{ this.form.total | toDecimals }}
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td>
                                    <el-button
                                        :disabled="loading"
                                        :loading="loading"
                                        class="btn-block"
                                        type="primary"
                                        @click="onSubmit"
                                    >
                                        <i class="fa fa-save"></i>
                                        <span class="ml-2">Guardar</span>
                                    </el-button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                        <div v-if="errors.products"
                             class="text-danger">
                            {{ errors.products[0] }}
                        </div>
                        <div v-if="this.products.length>0 && form.products.length  < 1"
                             class="pull-right">
                            <el-button
                                :disabled="loading"
                                :loading="loading"
                                class="btn-block"
                                type="primary"
                                @click="onTotalDeleteProduct"
                            >
                                <i class="fa fa-save"></i>
                                <span class="ml-2">Guardar</span>
                            </el-button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <tenant-documents-items-list
            :configuration="configuration"
            :editNameProduct="configuration.edit_name_product"
            :exchange-rate-sale="0"
            :isEditItemNote="false"
            :recordItem="recordItem"
            :showDialog.sync="showDialogAddItem"
            :typeUser="typeUser"
            :percentageIgv="percentage_igv"
            currency-type-id-active="PEN"
            operation-type-id="0101"
            @add="onAddItem"

        ></tenant-documents-items-list>
    </div>
</template>

<script>
// import DocumentFormItem from "../../../../../../../resources/js/views/tenant/documents/partials/item.vue";
import {functions} from "../../../../../../../resources/js/mixins/functions";
import moment from "moment";
import {mapState} from "vuex/dist/vuex.mjs";

export default {
    components: {
        // DocumentFormItem,
    },
    mixins: [
        functions
    ],
    props: {
        rent: {
            type: Object,
            required: true,
        },
        products: {
            type: Array,
            required: false,
            default: [],
        },
        configuration: {
            type: Object,
            required: true,
        },
        establishment: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            title: "",
            showDialogAddItem: false,
            recordItem: null,
            form: {
                products: [],
                subtotal: 0,
                total: 0,
                igv: 0,
                date_of_issue: moment().format("YYYY-MM-DD"),
                establishment_id: null,
            },
            errors: {},
            typeUser: "admin",
            loading: false,
        };
    },
    computed: {
        ...mapState([
            'config',
        ]),
    },
    mounted() {
        console.log(this.configuration);
        this.form.establishment_id = this.establishment.id;
        this.getPercentageIgv();
        if (this.products) {
            const products = this.products.map((p) => {
                p.item.payment_status = p.payment_status;
                return p.item;
            });
            this.form.products = products;
            this.onCalculateTotals();
        }
    },
    created() {
        this.title = `Habitación ${this.rent.room.name} - Agregar productos`;
    },
    methods: {
        onSubmit() {
            this.loading = true;
            this.$http
                .post(
                    `/hotels/reception/${this.rent.id}/rent/products/store`,
                    this.form
                )
                .then((response) => {
                    window.location.href = "/hotels/reception";
                    this.$message({
                        message: response.data.message,
                        type: "success",
                    });
                })
                .catch((error) => this.axiosError(error))
                .finally(() => (this.loading = false));
        },
        onTotalDeleteProduct() {
            this.$confirm(
                "¿Estás seguro de eliminar todos los productos?",
                "Cuidado",
                {
                    confirmButtonText: "Si",
                    cancelButtonText: "No",
                    type: "warning",
                }
            )
                .then(() => {
                    this.onSubmit()
                })
                .catch(() => {
                });
        },
        onDeleteProduct(product) {
            this.$confirm(
                "¿estás seguro de eliminar el producto seleccionado?",
                "Cuidado",
                {
                    confirmButtonText: "Si",
                    cancelButtonText: "No",
                    type: "warning",
                }
            )
                .then(() => {
                    this.form.products = this.form.products.filter(
                        (p) => p.item_id !== product.item_id
                    );
                    this.onCalculateTotals();
                })
                .catch(() => {
                });
        },
        onOpenModalProducts() {
            this.showDialogAddItem = true;
        },
        onCalculateTotals() {
            this.form.subtotal = this.form.products
                .map((p) => p.total_value)
                .reduce((a, p) => a + p, 0);
            this.form.igv = this.form.products
                .map((p) => p.total_igv)
                .reduce((a, p) => a + p, 0);
            this.form.total = this.form.subtotal + this.form.igv;
        },
        onAddItem(product) {
            const newProduct = {
                payment_status: "PAID",
                affectation_igv_type_id: product.affectation_igv_type_id,
                attributes: product.attributes,
                charges: product.charges,
                discounts: product.discounts,
                item_id: product.item_id,
                name_product_pdf: product.name_product_pdf,
                percentage_igv: product.percentage_igv,
                percentage_isc: product.percentage_isc,
                percentage_other_taxes: product.percentage_other_taxes,
                price_type_id: product.price_type_id,
                quantity: product.quantity,
                system_isc_type_id: product.system_isc_type_id,
                total: product.total,
                total_base_igv: product.total_base_igv,
                total_base_isc: product.total_base_isc,
                total_base_other_taxes: product.total_base_other_taxes,
                total_charge: product.total_charge,
                total_discount: product.total_discount,
                total_igv: product.total_igv,
                total_isc: product.total_isc,
                total_other_taxes: product.total_other_taxes,
                total_plastic_bag_taxes: product.total_plastic_bag_taxes,
                total_taxes: product.total_taxes,
                total_value: product.total_value,
                unit_price: product.unit_price,
                unit_value: product.unit_value,
                warehouse_id: product.warehouse_id,
                input_unit_price_value: product.input_unit_price_value,
                // item: {
                //   description: product.item.description,
                //   item_type_id: product.item.item_type_id,
                //   internal_id: product.item.internal_id,
                //   item_code: product.item.item_code,
                //   item_code_gs1: product.item.item_code_gs1,
                //   unit_type_id: product.item.unit_type_id,
                //   presentation: product.item.presentation,
                //   amount_plastic_bag_taxes: product.item.amount_plastic_bag_taxes,
                //   is_set: product.item.is_set,
                //   lots: product.item.lots,
                //   IdLoteSelected: product.item.IdLoteSelected,
                // },
                item: this.getNewItem(product)
            };

            const repeteads = this.form.products.filter(
                (p) => p.item_id === newProduct.item_id
            );
            if (repeteads.length > 0) {
                this.form.products = this.form.products.map((p) => {
                    if (p.item_id === newProduct.item_id) {
                        return newProduct;
                    }
                    return p;
                });
            } else {
                this.form.products.push(newProduct);
            }
            this.onCalculateTotals();
        },
        getNewItem(product) {

            let new_item = product.item

            // new_item.description = product.item.description
            // new_item.internal_id = product.item.internal_id
            // new_item.unit_type_id = product.item.unit_type_id
            // new_item.is_set = product.item.is_set
            // new_item.lots = product.item.lots
            // new_item.amount_plastic_bag_taxes = product.item.amount_plastic_bag_taxes
            new_item.item_type_id = product.item.item_type_id
            new_item.item_code = product.item.item_code
            new_item.item_code_gs1 = product.item.item_code_gs1
            new_item.presentation = product.item.presentation
            new_item.IdLoteSelected = product.item.IdLoteSelected

            return new_item

        },
        onGotoBack() {
            window.location.href = "/hotels/reception";
        },
    },
};
</script>
